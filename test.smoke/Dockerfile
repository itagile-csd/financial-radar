FROM alpine:3.3

RUN apk --no-cache add openssl

RUN wget -q -O /usr/local/bin/await \
	  https://github.com/betalo-sweden/await/releases/download/v0.4.0/await-linux-amd64 \
 && chmod +x /usr/local/bin/await

