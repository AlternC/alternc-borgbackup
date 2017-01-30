NAME=alernc-borgbackup
VERSION=1
ITERATION=`date +'%y%m%d%H%M%S'`

.PHONY: clean package

all: clean package

clean:
	rm -f $(NAME)_*.deb

package:
	fpm -s dir -t deb \
		-n $(NAME) \
		-v $(VERSION) \
		--iteration $(ITERATION) \
		-m alternc@webelys.com \
		--license GPLv3 \
		--category admin \
		--architecture all \
		--deb-build-depends "alternc (>= 3.2.10), fuse (>= 2.9.0)" \
		--after-install debian/postinst \
		--chdir src \
		.