 // Open the modal when the Comment button is clicked
 const openModalButtons = document.querySelectorAll('#openModalButton');
 const closeModalButton = document.getElementById('closeModal');
 const commentModal = document.getElementById('commentModal');

 openModalButtons.forEach(button => {
     button.addEventListener('click', () => {
         // Set the thread_id dynamically for the modal
         const threadId = button.getAttribute('data-thread-id');
         const threadIdInput = commentModal.querySelector('input[name="thread_id"]');
         threadIdInput.value = threadId;

         // Show the modal
         commentModal.classList.remove('hidden');
     });
 });

 closeModalButton.addEventListener('click', () => {
     commentModal.classList.add('hidden');
 });