FROM python:3.7

RUN \
    apt-get update -qq && \
    apt-get install -y \
    apt-utils

##install packages for celery worker
RUN pip install \
        celery[redis]==4.1.1 \
        pymysql==0.8.1 \
        python-dotenv \
        sqlalchemy

RUN rm -rf /root/.cache

## set the working directory
ADD . /usr/src/app

WORKDIR /usr/src/app
