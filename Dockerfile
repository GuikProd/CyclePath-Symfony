FROM debian

ENV WORKDIR "/var/www/cyclePath"

ADD . ${WORKDIR}

RUN rm -rf ${WORKDIR}/vendor \
    && ls -l ${WORKDIR}

RUN mkdir -p \
		${WORKDIR}/var/cache \
		${WORKDIR}/var/logs \
		${WORKDIR}/var/sessions \
	&& chown -R www-data ${WORKDIR}/var

RUN apt-get update -y && apt-get upgrade -y

CMD ['/bin/true']
