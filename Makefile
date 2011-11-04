all:
	cd documentrepository/js; make
	cd documentrepository/css; make

check:
	./integrity_check

clean:
	cd documentrepository/js; rm -rf *-min.js
	cd documentrepository/css; rm -rf *-min.css
