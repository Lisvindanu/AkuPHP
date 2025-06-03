<?php

// koneksi ke database
$conn = mysqli_connect("localhost:3306", "root", "password", "anaphygon_retro");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambahService($data)
{
    global $conn;

    $title = htmlspecialchars($data["title"]);
    $description = htmlspecialchars($data["description"]);
    $icon = htmlspecialchars($data["icon"]);
    $price_range = htmlspecialchars($data["price_range"]);
    $status = htmlspecialchars($data["status"]);

    // Upload gambar
    $image = upload();
    if (!$image) {
        return false;
    }

    $query = "INSERT INTO services (title, description, icon, image, price_range, status)
              VALUES ('$title', '$description', '$icon', '$image', '$price_range', '$status')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahProject($data)
{
    global $conn;

    $title = htmlspecialchars($data["title"]);
    $description = htmlspecialchars($data["description"]);
    $client_name = htmlspecialchars($data["client_name"]);
    $project_url = htmlspecialchars($data["project_url"]);
    $service_id = htmlspecialchars($data["service_id"]);
    $completion_date = htmlspecialchars($data["completion_date"]);
    $status = htmlspecialchars($data["status"]);
    $featured = isset($data["featured"]) ? 1 : 0;

    // Upload gambar
    $image = upload();
    if (!$image) {
        return false;
    }

    $query = "INSERT INTO projects (title, description, client_name, image, project_url, service_id, completion_date, status, featured)
              VALUES ('$title', '$description', '$client_name', '$image', '$project_url', '$service_id', '$completion_date', '$status', '$featured')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahTestimonial($data)
{
    global $conn;

    $client_name = htmlspecialchars($data["client_name"]);
    $client_position = htmlspecialchars($data["client_position"]);
    $client_company = htmlspecialchars($data["client_company"]);
    $testimonial_text = htmlspecialchars($data["testimonial_text"]);
    $rating = htmlspecialchars($data["rating"]);
    $project_id = htmlspecialchars($data["project_id"]);
    $featured = isset($data["featured"]) ? 1 : 0;
    $status = htmlspecialchars($data["status"]);

    // Upload foto client
    $client_photo = upload();
    if (!$client_photo) {
        return false;
    }

    $query = "INSERT INTO testimonials (client_name, client_position, client_company, testimonial_text, client_photo, rating, project_id, featured, status)
              VALUES ('$client_name', '$client_position', '$client_company', '$testimonial_text', '$client_photo', '$rating', '$project_id', '$featured', '$status')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    // Cek apakah input file 'gambar' ada
    if (!isset($_FILES['gambar'])) {
        return "nophoto.png"; // Default image
    }

    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        return "nophoto.png"; // Default image
    }

    // Cek apakah yang diupload adalah gambar
    $ekstensigambarValid = ['jpg', 'jpeg', 'png', 'webp'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensigambarValid)) {
        return false;
    }

    // Cek jika ukurannya terlalu besar (50MB)
    if ($ukuranfile > 50000000) {
        return false;
    }

    // Generate nama gambar baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    move_uploaded_file($tmpName, '../assets/img/' . $namafilebaru);

    return $namafilebaru;
}

function hapusService($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM services WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function hapusProject($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM projects WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function hapusTestimonial($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM testimonials WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function hapusMessage($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM contact_messages WHERE id = $id");
    return mysqli_affected_rows($conn);
}

// User registration
function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Username sudah terdaftar!');
        </script>";
        return false;
    }

    // Cek email sudah ada atau belum
    $result = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Email sudah terdaftar!');
        </script>";
        return false;
    }

    // Cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai!');
        </script>";
        return false;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");

    return mysqli_affected_rows($conn);
}

function ubahService($data)
{
    global $conn;
    
    $id = $data["id"];
    $title = htmlspecialchars($data["title"]);
    $description = htmlspecialchars($data["description"]);
    $icon = htmlspecialchars($data["icon"]);
    $price_range = htmlspecialchars($data["price_range"]);
    $status = htmlspecialchars($data["status"]);
    $imageLama = htmlspecialchars($data["imageLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $image = $imageLama;
    } else {
        $image = upload();
    }

    $query = "UPDATE services SET
        title = '$title', 
        description = '$description',
        icon = '$icon', 
        image = '$image',
        price_range = '$price_range',
        status = '$status'
        WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahProject($data)
{
    global $conn;
    
    $id = $data["id"];
    $title = htmlspecialchars($data["title"]);
    $description = htmlspecialchars($data["description"]);
    $client_name = htmlspecialchars($data["client_name"]);
    $project_url = htmlspecialchars($data["project_url"]);
    $service_id = htmlspecialchars($data["service_id"]);
    $completion_date = htmlspecialchars($data["completion_date"]);
    $status = htmlspecialchars($data["status"]);
    $featured = isset($data["featured"]) ? 1 : 0;
    $imageLama = htmlspecialchars($data["imageLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $image = $imageLama;
    } else {
        $image = upload();
    }

    $query = "UPDATE projects SET
        title = '$title', 
        description = '$description',
        client_name = '$client_name',
        image = '$image',
        project_url = '$project_url',
        service_id = '$service_id',
        completion_date = '$completion_date',
        status = '$status',
        featured = '$featured'
        WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cariServices($keyword)
{
    $query = "SELECT * FROM services
                WHERE 
            title LIKE '%$keyword%' OR
            description LIKE '%$keyword%' OR
            price_range LIKE '%$keyword%'
        ";
    return query($query);
}

function cariProjects($keyword)
{
    $query = "SELECT * FROM projects
                WHERE 
            title LIKE '%$keyword%' OR
            description LIKE '%$keyword%' OR
            client_name LIKE '%$keyword%'
        ";
    return query($query);
}

function kirimPesan($data)
{
    global $conn;

    $name = htmlspecialchars($data["name"]);
    $email = htmlspecialchars($data["email"]);
    $phone = htmlspecialchars($data["phone"]);
    $subject = htmlspecialchars($data["subject"]);
    $message = htmlspecialchars($data["message"]);
    $service_interest = htmlspecialchars($data["service_interest"]);
    $budget_range = htmlspecialchars($data["budget_range"]);

    $query = "INSERT INTO contact_messages (name, email, phone, subject, message, service_interest, budget_range)
              VALUES ('$name', '$email', '$phone', '$subject', '$message', '$service_interest', '$budget_range')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateMessageStatus($id, $status)
{
    global $conn;
    $query = "UPDATE contact_messages SET status = '$status' WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}