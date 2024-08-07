FROM ubuntu:latest

# Add crontab file in the cron directory
ADD crontab /tmp/crontab
ADD dump.sh /dump.sh

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

# Install Cron
RUN apt-get update
RUN apt-get -y install cron mysql-client
RUN chmod +x /dump.sh
RUN /usr/bin/crontab /tmp/crontab
RUN rm -f /tmp/crontab

CMD sleep 120 && service cron start && tail -f /var/log/cron.log