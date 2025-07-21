#!/bin/bash
set -ex

cd "$(dirname "$0")" || exit

docker compose up --pull always -d --remove-orphans