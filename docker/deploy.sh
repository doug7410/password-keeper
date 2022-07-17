#!/usr/bin/env bash

# build and
echo "Building container"
docker build -t doug7410/password-keeper:v1 -f docker/Dockerfile . && docker push doug7410/password-keeper:v1

# push
echo "Pushing container"
docker push doug7410/password-keeper:v1
#pull onto server
echo "Pulling container on server"
ssh ubuntu@money-view.doug-steinberg.rocks -i ~/.ssh/dougs_pem.pem -- sudo docker pull doug7410/password-keeper:v1

# restart container
echo "Restarting container"
ssh ubuntu@money-view.doug-steinberg.rocks -i ~/.ssh/dougs_pem.pem -- sudo docker-compose -f /docker/docker-compose.yml up -d

# npm buld
echo "Building assets"
ssh ubuntu@money-view.doug-steinberg.rocks -i ~/.ssh/dougs_pem.pem -- sudo docker exec docker_password-keeper_1 npm run build
