(function (window) {
	var lang = function (str) {
		const queryString = window.location.search;
		const urlParams = new URLSearchParams(queryString);
		if (
			typeof urlParams.get('debug') !== 'undefined' &&
			urlParams.get('debug') !== null &&
			typeof urlParams.get('lang') != 'undefined' &&
			urlParams.get('lang') !== null
		) {
			var localize = urlParams.get('lang');
		} else {
			var localize = navigator.language || navigator.userLanguage;
		}

		var def = 'en';
		if (typeof localize == 'undefined') {
			localize = def;
		} else {
			var local = localize.split('-');
			localize = local[0];
		}
		var store = {
			en: {
				title: 'FunnGame',
				'p2-step-pre-1-1': 'Welcome to Play',
				'p2-step-pre-1-2': 'Continue',
				'p2-step-pre-1-3': 'No, thanks',
				'p2-step-pre-2-1': 'Choose your first seductive <span class="accent">CHARACTER</span>',
				'p2-step-pre-2-2': 'Stepsister',
				'p2-step-pre-2-3': 'Stepmother',
				'p2-step-pre-3-1': 'Your stepmom is going to make you <span class="accent">BEG FOR IT</span>',
				'p2-step-pre-3-2': 'I want to play',

				'p2-step1-1': '3D Games',
				'p2-step1-2': "You WON'T EVEN last 30 seconds",
				'p2-step1-3': "Start game",

				'p2-step2-1':
					'Вefore we can allow you to play our adult games, we need to ask some quick questions.',
				'p2-step2-2':
					'This will personalize your gaming experience to make your game enjoyable.',

				'p2-step3-1':
					"Our games are very addictive and you'll see a lot of exciting scenes. Can you handle it?",
				'p2-group-yes': 'Yes',
				'p2-group-no': 'No',

				'p2-step4-1': 'Who do you want to see in these games?',
				'p2-step4-2': 'Stepsister',
				'p2-step4-3': 'Neighbor',
				'p2-step4-4': 'Famous Cartoons',
				'p2-step4-5': 'Others',

				'p2-step5-1': 'How big would you like her breast to be?',
				'p2-step5-2': 'Small',
				'p2-group-medium': 'Medium',
				'p2-group-big': 'Big',
				'p2-group-huge': 'Huge',

				'p2-step6-1': 'How do you like her booty?',
				'p2-step5-2': 'Small',
				'p2-group-medium': 'Medium',
				'p2-group-big': 'Big',
				'p2-group-huge': 'Huge',

				'p2-step6-1-1': 'How do you like her ass?',
				'p2-group-medium': 'Medium',
				'p2-group-big': 'Big',
				'p2-group-huge': 'Huge',

				'p2-step7-1':
					'Nice! We have over 1800 games for you. You can play single player & multiplayer',
				'p2-step7-2': 'But first, which type of game would you like to play?',
				'p2-step7-3': 'Quick game',
				'p2-step7-4': 'Role Playing Game',

				'p2-step8-1': 'Would you like the game to be hardcore?',
				'p2-group-yes': 'Yes',
				'p2-group-no': 'No',

				'p2-step9-1':
					'Make sure you are in a safe place to play the most hardcore game',
				'p2-step9-2': 'Of course',

				'p2-step11-1': 'How many times do you want to play?',
				'p2-step11-2': 'Just Once',
				'p2-step11-3': 'Again and again',

				'p2-step12-1': 'Choose game difficulty',
				'p2-step12-2': 'Easy',
				'p2-step12-3': 'Normal',
				'p2-step12-4': 'Hard',
				'p2-step12-5': 'Extreme',

				'p2-step13-1':
					'You will need to create an account and verify your age in order to access this games. Do you agree these terms?',
				'p2-group-yes': 'Yes',
				'p2-group-no': 'No',

				'p2-step14-1': 'Congrats!',
				'p2-step14-2': 'We found 11,131 players with your preferences.',
				'p2-group-continue': 'Continue',

				'p2-step15-1': 'Please remember:',
				'p2-step15-2': '1. Our games are extremely addicting',
				'p2-step15-3': '2. We recommend playing alone.',
				'p2-step15-4': '3. Lock your door before playing.',
				'p2-step15-5': 'I agree',

				'p2-step16-1': 'This game is compatible with your browser.',
				'p2-step16-2': 'No download is required.',

				'cookie-2': 'We use',
				'cookie-3': 'cookies',
				'cookie-4': 'to give you the best possible experience on our website. By clicking \'Ok, don\'t show it again\'',
				'cookie-5': 'or \'X\' on this banner, or using our site, you consent to the use of cookies unless you have disabled them.',
				'cookie-6': 'Ok',
				'cookie-7': 'don\'t show it again',
				'footer-1': 'Privacy Policy',
				'footer-2': 'copyright © 2023, Funn Games. All rights reserved',
			}
		};
		if (typeof store[localize] == 'undefined') {
			localize = def;
		}

		return store[localize][str];
	};
	document.title = lang('title');
	window.lang = lang;
	$('.multitext').each(function (e) {
		$(this).html(lang($(this).data('multitext')));
		$(this).attr('value', lang($(this).data('multitext1')));
	});
})(window);
