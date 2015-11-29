<h1>Les posts du Blog</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
    </tr>

    <!-- C'est ici que nous bouclons sur le tableau $posts afin d'afficher les informations des posts -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id_post']; ?></td>
        <td>
            <?php echo $post['Post']['name']; ?>
            
        </td>
      </tr>
    <?php endforeach; ?>

</table>