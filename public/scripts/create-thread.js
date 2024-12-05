document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imgPreview = document.createElement('img');
            imgPreview.src = e.target.result;
            imgPreview.style.maxWidth = '100%';
            document.body.appendChild(imgPreview);
        };
        reader.readAsDataURL(file);
    }
});

document.getElementById('video').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const videoPreview = document.createElement('video');
        videoPreview.controls = true;
        videoPreview.style.maxWidth = '100%';
        const source = document.createElement('source');
        source.src = URL.createObjectURL(file);
        source.type = file.type;
        videoPreview.appendChild(source);
        document.body.appendChild(videoPreview);
    }
});
