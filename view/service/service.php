<head>
    <link rel="stylesheet" href="./view/service/service.css">
</head>
<section id="service">
    <div class="services" style="margin-top: -4%">
        <div class="our-services">
            <h1 class="our">Our Service</h1>
            <hr class="separator separator--dots" />
        </div>
        <div class="icon-container">
            <?php
            $services = [
                [
                    'image' => 'assets/engineering.png',
                    'title' => 'Mechanical',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi reiciendis ut voluptas! Rerum illum, nam eos vero unde beatae sint ad ex, dicta amet nesciunt numquam molestiae officia placeat sed?'
                ],
                [
                    'image' => 'assets/tubes.png',
                    'title' => 'Piping',
                    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum repellat est rem quas laudantium id incidunt autem minima. Illum exercitationem nobis quisquam nihil quaerat atque alias temporibus veniam aliquid amet.'
                ],
                [
                    'image' => 'assets/scaffolding.png',
                    'title' => 'Structural & Scaffolding',
                    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel cupiditate rem ex libero tempore praesentium maiores? Harum iure quos voluptatum quam laudantium vero porro consectetur dolor quibusdam provident, expedita ex.'
                ]
            ];

            foreach ($services as $service) {
                echo '<div class="card">';
                echo '<img src="' . $service['image'] . '" alt="Avatar">';
                echo '<div class="container">';
                echo '<p class="title">' . $service['title'] . '</p>';
                echo '<p class="detail">' . $service['description'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>

<section id="about">
    <div class="about-component">
        <div class="about-content">
            <h1>About us</h1>
            <hr class="separator separator--dots" />
            <h2>Kunal Engineering Construction, founded in 2016 by Mukesh Kumar, is a dynamic company based in the vibrant state of Gujarat, India. Specializing in a wide spectrum of construction and contracting services,</h2>
            <h2 id="extra_content" class="extra_content">Kunal Engineering Construction is at the forefront of the industry. The company excels in various fields, including mechanical, piping, structural, and scaffolding works, meeting the diverse needs of its clients. One of its distinguishing features is its ability to provide highly skilled manpower, facilitating the successful execution of projects. With a notable track record, Kunal Engineering Construction has played a pivotal role in significant endeavors like HMEL's Guru Gobind Singh Petroleum Refinery and the Visakhapatnam Underground Tunnel. Moreover, the company's commitment to a responsive website design ensures that users can access information from a variety of devices, enhancing accessibility. The inclusion of user parameters, offering details on projects, job openings, contact information, and the head office address, reflects Kunal Engineering Construction's dedication to transparency and engaging with its audience.</h2>
            <button id="read_more" class="read_more">Show More</button>
        </div>
    </div>
</section>