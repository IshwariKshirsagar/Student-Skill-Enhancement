<?php
// OPTIONAL: You can later load this from database
$videos = [
    [
        "id" => "VIDEO_ID_1",
        "title" => "Ekaki Chapter 3 : Invasion | Ashish Chanchlani | ACV Studios",
        "channel" => "ashish chanchlani vines",
        "views" => "18M views",
        "time" => "2 weeks ago",
        "duration" => "30:42",
        "desc" => "And now begins the real story of EKAKI. We officially welcome you to the first sci-fi comedy of our country ❤️"
    ],
    [
        "id" => "VIDEO_ID_2",
        "title" => "Ekaki Chapter 2 : Arrival | Ashish Chanchlani | ACV Studios",
        "channel" => "ashish chanchlani vines",
        "views" => "25M views",
        "time" => "1 month ago",
        "duration" => "44:37",
        "desc" => "Lo dosto, channel ki anniversary par aap sabko mera sabse bada gift..."
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>YouTube Videos</title>

<!-- Bootstrap (your project already has it, keep if not) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>
.youtube-card {
    display: flex;
    gap: 15px;
    padding: 15px;
    border-radius: 12px;
    background: #ffffff;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    margin-bottom: 16px;
    transition: transform 0.2s ease;
}

.youtube-card:hover {
    transform: translateY(-3px);
}

.youtube-thumb {
    position: relative;
    min-width: 280px;
}

.youtube-thumb img {
    width: 100%;
    border-radius: 10px;
}

.youtube-duration {
    position: absolute;
    bottom: 8px;
    right: 8px;
    background: rgba(0,0,0,0.85);
    color: #fff;
    font-size: 12px;
    padding: 2px 6px;
    border-radius: 4px;
}

.youtube-content h5 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 4px;
}

.youtube-meta {
    font-size: 13px;
    color: #6c757d;
    margin-bottom: 6px;
}

.youtube-desc {
    font-size: 14px;
    color: #555;
}

@media (max-width: 768px) {
    .youtube-card {
        flex-direction: column;
    }
    .youtube-thumb {
        min-width: 100%;
    }
}
</style>
</head>

<body class="bg-light">

<div class="container mt-4">

    <h4 class="mb-3">Latest Videos</h4>

    <?php foreach ($videos as $v): ?>
    <div class="youtube-card">
        <div class="youtube-thumb">
            <a href="https://www.youtube.com/watch?v=<?=$v['id']?>" target="_blank">
                <img src="https://img.youtube.com/vi/<?=$v['id']?>/maxresdefault.jpg">
                <span class="youtube-duration"><?=$v['duration']?></span>
            </a>
        </div>

        <div class="youtube-content">
            <h5><?=$v['title']?></h5>
            <div class="youtube-meta">
                <?=$v['channel']?> • <?=$v['views']?> • <?=$v['time']?> • 4K • CC
            </div>
            <div class="youtube-desc">
                <?=$v['desc']?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</div>

</body>
</html>
