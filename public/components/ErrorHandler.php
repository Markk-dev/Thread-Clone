<?php
namespace App\Components;

class ErrorHandler
{
    /**
     * Error
     *
     * @param string $message
     */
    public static function displayError($message)
    {
        echo "
        <div id='error-message' class='absolute z-10 bg-red-500 text-white p-2 rounded-md ml-[360px]'>
            <strong>Error:</strong> $message
        </div>
        <script>
            setTimeout(function() {
                var errorMessage = document.getElementById('error-message');
                if (errorMessage) errorMessage.remove();
            }, 2000);
        </script>
        ";
    }

}
