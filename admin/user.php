<?php
    require_once '../userController.php';
    /*session_start();*/
    /*include './includes/config.php';*/
    $user=new UserController();
    $user_create=false;
    $roles=$user->getRoles();
    if (isset($_GET['action'])){
        $action=$_GET['action'];
        switch ($action){
            case 'delete':
                if (isset($_GET['id'])){
                    $user->delete($_GET['id']);
                    header('Location: user.php');
                }
                break;
                case 'update':
                    if (isset($_GET['id'])) {
                        $idToUpdate = intval($_GET['id']);
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $firstname = $_POST['firstname'];
                            $name = $_POST['name'];
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $user->update($idToUpdate, $firstname, $name, $username, $password);
                            header('Location: user.php');
                            exit;
                        } 
                        else {
                            $users = $user->read();
                            $userToEdit = null;
                            foreach ($users as $user) {
                                if ($user['user_id'] == $idToUpdate) {
                                    $userToEdit = $user;
                                    break;
                                }
                            }
                        }
                    }
                                    break;
                case 'create':
                    if (isset($_GET['complete'])){
                        $user_create=false;
                        $username = $_POST['username'];
                            $password = $_POST['password'];
                            $name = $_POST['name'];
                            $firstname = $_POST['firstname'];
                            $role = $_POST['roles'];
                            $user->create($firstname, $name, $username, $password, $role);
                        header('Location: user.php');
                    }
                    else {
                        $user_create=true;
                    }
        }
    }
    if (!isset($users)){
    $users=$user->read();
    }    
    ?>

    <a href="/project/admin/user.php?action=create">
        <button>Créer user</button></a>

        <?php if ($user_create): ?>
        
        <h2>Créer user</h2>
    <form action="user.php?action=create&complete=true" method="POST">
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" value="" required>
        <label for="name">Nom</label>
        <input type="text" name="name" value="" required>
        <label for="username">Email</label>
        <input type="text" name="username" value="" required>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" value="" required>
        <select name="roles" id="roles">
            <?php foreach ($roles as $role):?>
                <option value="<?php echo htmlspecialchars($role['role_id'])?>"><?php echo htmlspecialchars($role['label'])?></option>
                <?php endforeach; ?>
        </select>
        <button type="submit">Créer</button>
    </form>

    <?php endif; ?>
