const express = require('express');
const dotenv = require('dotenv');

const app = express();
dotenv.config();

// set the view engine to ejs
app.set('view engine', 'ejs');

// Index page
app.get('/', (req, res) => {
	let mascots = [
		{ name: 'Andrei', birth_year: 2012 },
		{ name: 'Ion', birth_year: 2001 },
	];

	let tagline = 'No programming concept is complete without a cute animal mascot';

	res.render('pages/index', {
		mascots: mascots,
		tagline: tagline,
	});
})

// About page
app.get('/about', (req, res) => {
	res.render('pages/about');
})

app.listen(process.env.SERVER_PORT, () => {
	console.log('Server listen on ', process.env.SERVER_PORT);
});