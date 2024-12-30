<?php 

require_once 'user.php';
require_once 'contacts.php';
require_once 'projects.php';


if (isset($_POST['add'])) {

    $title = $_POST['title'];
    $desc = $_POST['description'];
    $image = $_POST['image'];
    $link = $_POST['link'];

    $project = new Projects();
    $result = $project->insert($title, $desc, $image, $link);

    if ($result == "Success") {
      ?>
      <script>
        alert("Inserted Successfully");
      </script>
      <?php
    } else {
      $error = $result;
      echo $error;
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $image = $_POST['image'];
    $link = $_POST['link'];

    $project = new Projects();
    $result = $project->update($id, $title, $desc, $image, $link);

    if ($result == "Success") {
      ?>
      <script>
        alert("Updated Successfully");
      </script>
      <?php
    } else {
      $error = $result;
      echo $error;
    }
}

if (isset($_POST['delete'])) {

    $id = $_POST['id'];

    $project = new Projects();
    $result = $project->delete($id);

    if ($result == "Success") {
      ?>
      <script>
        alert("Deleted Successfully");
      </script>
      <?php
    } else {
      $error = $result;
      echo $error;
    }
}

$contact = new Contacts();
$result = $contact->getContacts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/New%20Portfolio/style.css">
</head>
<body>
    <header>
        <div class="header">
            <div class="logo">
                <h1>AG</h1>
            </div>
        </div>
    </header>
    <main>
        <div class="admin">
            <form method="POST" style="background-color: #212529; color: white;">
                <h1>Login</h1>
                <div class="admin-form">
                    <label for="uName">Username
                        <input type="text" name="username" id="uName" style="width: 200px;" required>
                    </label>
                    <label for="pwd">Password
                        <input type="text" name="password" id="pwd" style="width: 200px;" required>
                    </label>
                </div>
                <button type="submit" name="submit" style="width: 100px;">Login</button>
            </form>
        </div>
        <div class="display" style="display: none;">
            <div class="project-wrapper">
                <div class="proj">
                    <form method="post">
                        <div class="proj-form">
                            <h1>Insert Project</h1>
                            <div>
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" placeholder="Add title" required>
                            </div>
                            <div>
                                <label for="description">Description</label>
                                <textarea name="description" id="description" rows="10" placeholder="Add description"></textarea>
                            </div>
                            <div>
                                <label for="image">Image</label>
                                <input type="text" id="image" name="image" placeholder="Add image">
                            </div>
                            <div>
                                <label for="link">Link</label>
                                <input type="text" id="link" name="link" placeholder="Add link">
                            </div>
                        </div>
                        <button type="submit" name="add">Add</button>
                    </form>
                </div>
                <div class="proj">
                    <form method="post">
                        <div class="proj-form">
                            <h1>Modify Project</h1>
                            <div>
                                <label for="id">ID</label>
                                <input type="text" id="id" name="id" placeholder="ID" required>
                            </div>
                            <div>
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" placeholder="Add title" required>
                            </div>
                            <div>
                                <label for="description">Description</label>
                                <textarea name="description" id="description" rows="10" placeholder="Add description"></textarea>
                            </div>
                            <div>
                                <label for="image">Image</label>
                                <input type="text" id="image" name="image" placeholder="Add image">
                            </div>
                            <div>
                                <label for="link">Link</label>
                                <input type="text" id="link" name="link" placeholder="Add link">
                            </div>
                        </div>
                        <button type="submit" name="update">Update</button>
                    </form>
                </div>
                <div class="proj">
                    <form method="post">
                        <div class="proj-form">
                            <h1>Delete Project</h1>
                            <div>
                                <label for="id">ID</label>
                                <input type="text" id="id" name="id" placeholder="ID" required>
                            </div>
                        </div>
                        <button type="submit" name="delete">Delete</button>
                    </form>
                </div>
            </div>
            <div class="table-wrapper">
                <h1 style="text-align: center;">Contacts</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                foreach($result as $row) {
                                    ?>
                                        <td><?php echo $row['name']?></td>
                                        <td><?php echo $row['email']?></td>
                                        <td><?php echo $row['subject']?></td>
                                        <td><?php echo $row['message']?></td>
                                    <?php
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];


            $user = new User();
            if ($user->login($username, $password)) {
                ?>
                    <script>
                        const admin = document.querySelector('.admin'); 
                        const display = document.querySelector('.display');
                        admin.style.display = "none";
                        display.style.display = "block";
                        alert("Login Successfully")
                    </script>
                <?php
            }
            else {
                ?>
                    <script>
                        alert("Invalid username or password")
                    </script>
                <?php
            }
        }
    ?>
</body>
</html>