<head>
    <link href="./view/contact/contact.css" rel="stylesheet">
</head>
<section id="contact">
    <div class="services">
        <div class="our-services">
            <h1 class="our">Contact Us</h1>
            <hr class="separator separator--dots" />
        </div>
        <div class="icon-container">
            <?php
            $contactMethods = [
                [
                    'image' => 'assets/live-chat (1).png',
                    'title' => 'By Phone',
                    'description' => '<small>(Monday to Friday, 9am to 6pm PST)</small><br>India Toll-Free:<br>+917623070356',
                ],
                [
                    'image' => 'assets/monitor.png',
                    'title' => 'Start a new case',
                    'description' => 'Just send us your questions or concerns by starting a new case, and we will give you the help you need.',
                    'buttonText' => 'Start Here',
                    'buttonLink' => '#starthear'
                ],
                [
                    'image' => 'assets/live-chat.png',
                    'title' => 'Live Chat',
                    'description' => 'Chat with a member of our in-house team.',
                    'buttonText' => 'Start Chat',
                    'buttonLink' => 'https://api.whatsapp.com/send?phone=6356799791',
                    'buttonClass' => 'liveChatApp',
                    'buttonTarget' => '_blank'
                ]
            ];

            foreach ($contactMethods as $method) {
                echo '<div class="card">';
                echo '<img src="' . $method['image'] . '" alt="Avatar">';
                echo '<div class="container">';
                echo '<p class="title">' . $method['title'] . '</p>';
                echo '<p class="detail">' . $method['description'] . '</p>';
                echo '</div>';
                if (isset($method['buttonText'])) {
                    $buttonTarget = isset($method['buttonTarget']) ? ' target="' . $method['buttonTarget'] . '"' : '';
                    $buttonClass = isset($method['buttonClass']) ? ' class="' . $method['buttonClass'] . '"' : '';
                    echo '<div class="button">';
                    echo '<a href="' . $method['buttonLink'] . '"' . $buttonTarget . $buttonClass . ' title="' . $method['buttonText'] . '">' . $method['buttonText'] . '</a>';
                    echo '</div>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>