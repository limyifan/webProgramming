<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <label>Name:</label><input name="name"><br>
    <label>Email:</label><input name="email"><br>
  <label>Password:</label>  <input name="pass"><br>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>