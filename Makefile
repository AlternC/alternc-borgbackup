NAME=alternc-borgbackup
VERSION=$(shell git tag -l --points-at HEAD)
ITERATION=""

ifeq ($(strip $(VERSION)),)
	VERSION=$(shell git describe --tags --abbrev=0)
	ifeq ($(strip $(VERSION)),)
		VERSION="0.0.0"
	endif
	ITERATION=`date +'%y%m%d%H%M%S'`
endif

.PHONY: clean package

all: clean package

clean:
	rm -f $(NAME)_*.deb

translate:
	po2debconf -o debian/templates debian/templates

package:
	fpm -s dir -t deb \
		-n $(NAME) \
		-v $(VERSION) \
		--iteration $(ITERATION) \
		-m alternc@webelys.com \
		--license GPLv3 \
		--category admin \
		--architecture all \
		--depends "alternc (>= 3.2.10), borgbackup, fuse" \
		--after-install "debian/postinst" \
		--chdir src \
		.