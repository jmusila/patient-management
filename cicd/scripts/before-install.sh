#!/bin/bash
  AWS_DEFAULT_REGION=$(curl http://169.254.169.254/latest/dynamic/instance-identity/document|grep region|awk -F\" '{print $4}')
  INSTANCE_ID=$(wget -qO- http://169.254.169.254/latest/meta-data/instance-id)
  NAME_TAG_VALUE=$(aws ec2 describe-tags --filters "Name=resource-id,Values=$INSTANCE_ID" "Name=key,Values=Name" --region "$AWS_DEFAULT_REGION" --output=text | cut -f5)
  DOMAIN=$(aws ssm get-parameter --name /"$NAME_TAG_VALUE"/BackendDomain --query Parameter --region "${AWS_DEFAULT_REGION}" | jq -r ."Value")
  NGINX_CONFIG=/etc/nginx/sites-available/"$DOMAIN"
  WEB_ROOT=/var/www/html/"$DOMAIN"
  CONFIG=/var/www/html/"$DOMAIN"/.env

 sudo apt-add-repository -r ppa:certbot/certbot
 sudo apt -y update

[ ! -d "/apps/patient-management" ] && mkdir -p /apps/patient-management

if [ ! -d "$WEB_ROOT" ]; then
    rm -rf /var/www/html/*
    mkdir -p /var/www/html/"$DOMAIN"
fi

if ! [ -x "$(command -v jq)" ]; then
  apt -y install jq
fi

if ! [ -x "$(command -v aws)" ]; then
  apt -y install awscli
fi

if ! [ -x "$(command -v amazon-cloudwatch-agent-ctl)" ]; then
  apt -y install amazon-cloudwatch-agent
fi

if ! [ -x "$(command -v collectd)" ]; then
  apt -y install collectd
fi

if ! [ -x "$(command -v pip3)" ]; then
  apt -y install python3 python3-pip
fi

# Check if supervisor command exists, if not, install
if ! [ -x "$(command -v supervisor)" ]; then
  apt -y install supervisor
fi

if [ ! -f "$NGINX_CONFIG" ]; then
    rm -rf /etc/nginx/sites-available/*
    rm -rf /etc/nginx/sites-enabled/*
fi

if [ -f "$CONFIG" ]; then
    rm -rf /var/www/html/"$DOMAIN"/.env*
fi
# Download cw agent
wget https://s3.amazonaws.com/amazoncloudwatch-agent/ubuntu/amd64/latest/amazon-cloudwatch-agent.deb

# Install cw agent
if ! [ -x "$(command -v amazon-cloudwatch-agent-ctl)" ]; then
  logger_msg "==========================="
  logger_msg "Install Cloudwatch agent"
  curl -o "$HOME"/amazon-cloudwatch-agent.deb https://s3.amazonaws.com/amazoncloudwatch-agent/debian/amd64/latest/amazon-cloudwatch-agent.deb
  sudo dpkg -i -E amazon-cloudwatch-agent.deb
fi