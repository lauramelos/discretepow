all:
	make css

instagram-css:
	stylus sources/styles/instagram.styl -o .

css:
	stylus sources/styles/style.styl -o .

