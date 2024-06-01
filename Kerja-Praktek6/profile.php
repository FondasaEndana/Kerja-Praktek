<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Akun</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.profile-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 300px;
}

.profile-header img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 10px;
}

.profile-header h2 {
    margin: 0;
}

.profile-info p {
    margin: 10px 0;
    font-size: 16px;
}

#edit-profile-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
}

#edit-profile-button:hover {
    background-color: #0056b3;
}

</style>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <img src="default-avatar.png" alt="Profile Picture" id="profile-picture">
            <h2 id="profile-name">Nama Pengguna</h2>
        </div>
        <div class="profile-info">
            <p>Email: <span id="profile-email">email@example.com</span></p>
            <p>Nomor HP: <span id="profile-phone">+6281234567890</span></p>
            <p>Saldo: <span id="profile-balance">Rp 0</span></p>
        </div>
        <button id="edit-profile-button">Edit Profile</button>
    </div>
    <script src="script.js"></script>
</body>
</html>
