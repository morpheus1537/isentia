

/***
 * Modals
 */


document.addEventListener('DOMContentLoaded', function(){
	
	if(document.querySelectorAll('.open-modal').length > 0){

		
		var modalButtons = document.querySelectorAll('.open-modal'),
			closeModalButtons = document.querySelectorAll('.close-modal'),
			modals = document.querySelectorAll('.modal'),
			theBody = document.getElementsByTagName('html')[0],
			iframePlayers = document.querySelectorAll('iframe');
		var i=0;
			
			
		
		/* Open modal
		--------------------------------------------- */
		for (i = 0; i < modalButtons.length; i++) {
			modalButtons[i].addEventListener('click', function(e){
				e.preventDefault();
				
				var modalWindowID = this.getAttribute('data-modalid');
										
				document.querySelectorAll('.modal[data-modalid="'+modalWindowID+'"]')[0].classList.add('active');
				
				theBody.classList.add('modal-open');
				
			});
		}
		

		/* Stop playing the youtubes
		--------------------------------------------- */
		function stopPlayers (){
			for (i = 0; i < iframePlayers.length; i++) {
			
				var iframesrc = iframePlayers[i].getAttribute('src');
			
				iframePlayers[i].setAttribute('src', iframesrc);
			
			
			}
			
		}
		
		
		/* Close modals
		--------------------------------------------- */
		function closeModals(){
			theBody.classList.remove('modal-open');
			stopPlayers();
			for (i = 0; i < modals.length; i++) {
				modals[i].classList.remove('active');
			}
		}
		
		
		for (i = 0; i < closeModalButtons.length; i++) {
			closeModalButtons[i].addEventListener('click', function(e){
				closeModals();
			});
		}
	}
	
});
