<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram - Profile</title>
  </head>
  <body>
    <div class="container">
      <h2>Profile <?php echo $this->data['user']->getUsername(); ?></h2>

      <?php foreach ($this->data['user']->getPosts() as $post): ?>

        <div class="card mt-2">
          <div class="card-body">
            <img class="w-25" class="rounded-circle" src="<?php echo $post->getUser()->getProfileUrl(); ?>"/>
            <?php echo $post->getUser()->getUsername(); ?>
          </div>
          <img class="w-100" src="<?php echo $post->getImageUrl(); ?>" />
          <div class="card-body">
                        
            <div class="card-title">
              <form action="addLike" method="POST">
                <input type="hidden" name="post_id" value="<?php echo $post->getId() ?>">
                <input type="hidden" name="origin" value="profile/<?php echo $post->getUser()->getUsername(); ?>">
                <button type="submit" class="btn btn-danger"><?php echo $post->getLikes(); ?> Likes</button>
              </form>
            </div>
            <p class="card-text"><?php echo $post->getTitle(); ?></p>
          </div>
        </div>

      <?php endforeach; ?>
    </div>
  </body>
</html>