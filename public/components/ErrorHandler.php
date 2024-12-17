<?php
class ErrorHandler {
    public function displayError($message) {
        echo "
        <div id='error-message' class='fade-out absolute z-10 bg-red-500 ml-[360px] text-white p-2  rounded-md mt-[-x]'>
            <strong>Error:</strong> $message
        </div>


        <script>
            setTimeout(function() {
                var errorMessage = document.getElementById('error-message');
                errorMessage.classList.add('hidden');
            }, 2000);
        </script>
        ";
    }
}
?>
