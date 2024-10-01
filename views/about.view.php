<?php
// Define some sample data to be displayed on the about page
$aboutInfo = [
    'title' => 'About Our Company',
    'description' => 'We are a leading company in delivering top-notch services. Our team of professionals are dedicated to providing the best solutions for our clients.',
    'mission' => 'Our mission is to innovate and lead in our industry, delivering exceptional value to our customers.',
    'vision' => 'We envision a world where technology meets every aspect of life seamlessly.',
    'team' => [
        'John Doe - CEO',
        'Jane Smith - CTO',
        'Mike Johnson - Lead Developer'
    ]
];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css">
    <title>About Us</title>
</head>
<body class="">

<?php include "./partials/nav.php"; ?>

<!-- Main Content Section -->
<main class="max-w-4xl mx-auto p-6 mt-8">
    <!-- Company Description -->
    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Who We Are</h2>
        <p class="text-lg leading-relaxed">
            <?= htmlspecialchars($aboutInfo['description']) ?>
        </p>
    </section>

    <!-- Mission Section -->
    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Our Mission</h2>
        <p class="text-lg leading-relaxed">
            <?= htmlspecialchars($aboutInfo['mission']) ?>
        </p>
    </section>

    <!-- Vision Section -->
    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Our Vision</h2>
        <p class="text-lg leading-relaxed">
            <?= htmlspecialchars($aboutInfo['vision']) ?>
        </p>
    </section>

    <!-- Team Section -->
    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Meet Our Team</h2>
        <ul class="list-disc list-inside">
            <?php foreach ($aboutInfo['team'] as $member): ?>
                <li class="text-lg">
                    <?= htmlspecialchars($member) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>

<!-- Footer Section -->
<footer class="bg-blue-600 p-4 mt-auto text-center text-white">
    <p>&copy; <?= date('Y') ?> Our Company. All rights reserved.</p>
</footer>
<script src="https://cdn.tailwindcss.com"></script>

</body>
</html>
