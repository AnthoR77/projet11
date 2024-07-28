<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Natalie Mota</title>
    <?php wp_head() ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <header>
        
        <nav class="nav">
        <div class="logo">
				<a href="<?php echo home_url('/'); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo">
				</a>
			</div>
            <button id="burger-btn">
        <span class="burger-bar"></span>
        <span class="burger-bar"></span>
        <span class="burger-bar"></span>
    </button>
            <?php wp_nav_menu([
                'theme_location' => 'primary',
            ]); ?>

        </nav>
    </header>