#!/usr/bin/env bash

docker build -t doug7410/money-mountain:v1 -f docker/Dockerfile . && docker push doug7410/money-mountain:v1