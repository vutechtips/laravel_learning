<!DOCTYPE html>
<html>
<head>
    <title>Upload Ảnh BĐS</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Upload Ảnh Bất Động Sản</h1>
    
    <form id="uploadForm" enctype="multipart/form-data">
        @csrf
        <input type="file" name="images[]" multiple accept="image/*">
        <button type="submit">Upload</button>
    </form>
    
    <div id="preview"></div>

    <script>
    document.getElementById('uploadForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        try {
            const response = await fetch('/upload-image', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                alert('Upload thành công!');
                console.log(data.images);
            }
        } catch (error) {
            alert('Upload thất bại!');
            console.error(error);
        }
    });
    </script>
</body>
</html>