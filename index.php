<?php
include 'db.php';
$name = $email = $student_id = $department = $major = $dob = $address = "";
$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $student_id = $_POST["student_id"];
    $department = $_POST["department"];
    $major = $_POST["major"];
    $dob = $_POST["dob"];
    $address = $_POST["address"];

    if (empty($name) || empty($email)) {
        $error = "Name and Email are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO students (name, email, student_id, department, major, dob, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $student_id, $department, $major, $dob, $address);
        $stmt->execute();
        $stmt->close();
        $success = "Student registered successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 750px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }
        nav a {
            text-decoration: none;
            color: #007bff;
            font-weight: 600;
            transition: color 0.3s;
        }
        nav a:hover {
            color: #0056b3;
        }
        h2 {
            font-weight: 700;
            color: #343a40;
            margin-bottom: 25px;
            text-align: center;
        }
        .form-label {
            font-weight: 500;
        }
        .form-control {
            border-radius: 0.7rem;
        }
        .btn-primary {
            border-radius: 0.7rem;
            padding: 10px 25px;
            font-weight: 600;
        }
        .table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }
        .alert {
            border-radius: 0.7rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Registration</h2>
        <nav>
            <a href="index.php">Add Student</a>
            <a href="student_list.php">Student List</a>
            <a href="enroll_course.php">Enroll in Course</a>
            <a href="enrollment_history.php">Enrollment History</a>
        </nav>

        <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Student ID</label>
                <input type="text" name="student_id" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Department</label>
                <select name="department" class="form-control">
                    <option value="">Select Department</option>
                    <option value="CSE">CSE</option>
                    <option value="EEE">EEE</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Major</label>
                <select name="major" class="form-control">
                    <option value="">Select Major</option>
                    <option value="AI">AI</option>
                    <option value="Networking">Networking</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
