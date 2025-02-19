<?php
    include '../includes/header.php';
    require_once '../controllers/UserController.php';
    /*session_start();*/
    /*include './includes/config.php';*/
    $user=new UserController();
    $user_create=false;
    $roles=$user->getRoles();
    if (isset($_GET['action'])){
        $action=$_GET['action'];
        switch ($action){
            case 'delete':
                if (isset($_GET['username'])){
                    $user->delete($_GET['username']);
                    header('Location: user.php');
                }
                break;
                case 'update':
                    if (isset($_GET['username'])) {
                        $idToUpdate = $_GET['username'];
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $firstname = $_POST['firstname'];
                            $name = $_POST['name'];
                            $username = $_POST['username'];
                            $user->update($idToUpdate, $firstname, $name, $username);
                            header('Location: user.php');
                            exit;
                        } 
                        else {
                            $users = $user->read();
                            $userToEdit = null;
                            foreach ($users as $user) {
                                if ($user['username'] == $idToUpdate) {
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
                    break;
        }
    }
    if (!isset($users)){
    $users=$user->read();
    }    
    ?>
    <div class="main-container">
    <a href="admin/user.php?action=create">
        <button class="btn">Créer user</button></a>

        <?php if ($user_create): ?>
        
    <form class="basic-form" action="admin/user.php?action=create&complete=true" method="POST">
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" value="" required>
        <label for="name">Nom</label>
        <input type="text" name="name" value="" required>
        <label for="username">Email</label>
        <input type="text" name="username" value="" required>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" value="" required>
        <label for="role">Role</label>
        <select name="roles" id="roles">
            <?php foreach ($roles as $role):?>
                <option value="<?php echo htmlspecialchars($role['role_id'])?>"><?php echo htmlspecialchars($role['label'])?></option>
                <?php endforeach; ?>
        </select>
        <button class="btn" type="submit">Créer</button>
    </form>
    <?php endif; ?>
    <div class="users">
        <?php foreach($users as $user):?>
            <div class="user">
                <p>email: <?php echo htmlspecialchars($user['username'])?></p>
                <p>name: <?php echo htmlspecialchars($user['name'])?></p>
                <p>firstname: <?php echo htmlspecialchars($user['firstname'])?></p>
                <div class="action-buttons">
                    <a href="admin/user.php?action=update&username=<?php echo htmlspecialchars($user['username'])?>">
                        <button class="btn-blue">
                            Mis à jour
                        </button>
                    </a>
                    <a href='admin/user.php?action=delete&username=<?php echo htmlspecialchars($user['username']);?>'>
                        <button class="btn-red">
                            Supprimer
                        </button>
                    </a>
                </div>

                <?php if (isset($userToEdit)&& $user['username']== $userToEdit['username']): ?>
    
            <form action="admin/user.php?action=update&username=<?php echo htmlspecialchars($userToEdit['username']); ?>" method="POST">

                <input type="text" name="username" value="<?php echo htmlspecialchars($userToEdit['username']); ?>" required>
                <input type="text" name="name" value="<?php echo htmlspecialchars($userToEdit['name']); ?>" required>
                <input type="text" name="firstname" value="<?php echo htmlspecialchars($userToEdit['firstname']); ?>" required>
        
        <button type="submit">Mettre à jour</button>
        
            </form>

    <?php endif; ?>

            </div>
            <?php endforeach;?>
            
            </div>
        </div>

