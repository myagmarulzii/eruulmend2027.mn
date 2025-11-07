<section class="hero">
    <div class="container hero-inner">
        <div class="hero-text">
            <h1>"Эрүүл мэндийг дэмжих жил 2027"</h1>
            <p>Эрүүл мэндийн салбарын хөгжлийн гарцад хамтдаа анхаарлаа хандуулж, эмч эмнэлгийн ажилчдын дуу хоолойг сонсоцгооё.</p>
            <a class="cta-button" href="#suggestion-form">Саналаа илгээх</a>
        </div>
        <div class="hero-logo">
            <div class="logo-emblem">
                <span class="logo-ring"></span>
                <span class="logo-heart"></span>
                <span class="logo-text">2027</span>
            </div>
            <p class="logo-caption">Эрүүл мэндийг дэмжих жил</p>
        </div>
    </div>
</section>
<section class="stats">
    <div class="container">
        <h2>Ирсэн саналын тойм</h2>
        <div class="stats-grid">
            <?php foreach ($categories as $key => $label): ?>
                <div class="stat-card">
                    <h3><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="stat-number"><?php echo $counts[$key] ?? 0; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section id="suggestion-form" class="form-section">
    <div class="container">
        <h2>Санал, хүсэлт хүлээн авах хэсэг</h2>
        <p>Салбарынхаа тулгамдсан асуудал, шинэ санаачилга, бүтээлч шийдлийг бидэнтэй хуваалцаарай.</p>

        <?php if (!empty($success)): ?>
            <div class="alert success"><?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert error">
                <p>Санал илгээхэд дараах алдааг засна уу:</p>
                <ul>
                    <?php foreach ($errors as $message): ?>
                        <li><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/submit" method="POST" class="suggestion-form">
            <div class="form-grid">
                <label>
                    <span>Овог, нэр*</span>
                    <input type="text" name="name" value="<?php echo htmlspecialchars(old('name'), ENT_QUOTES, 'UTF-8'); ?>" required>
                </label>
                <label>
                    <span>Ажлын байр / Байгууллага*</span>
                    <input type="text" name="organization" value="<?php echo htmlspecialchars(old('organization'), ENT_QUOTES, 'UTF-8'); ?>" required>
                </label>
                <label>
                    <span>Цахим шуудан</span>
                    <input type="email" name="email" value="<?php echo htmlspecialchars(old('email'), ENT_QUOTES, 'UTF-8'); ?>" placeholder="name@example.mn">
                </label>
                <label>
                    <span>Саналын төрөл*</span>
                    <select name="category" required>
                        <option value="">-- Сонгоно уу --</option>
                        <?php foreach ($categories as $key => $label): ?>
                            <option value="<?php echo $key; ?>" <?php echo old('category') === $key ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>
            <label class="full-width">
                <span>Санал, шийдлийн дэлгэрэнгүй*</span>
                <textarea name="message" rows="6" required><?php echo htmlspecialchars(old('message'), ENT_QUOTES, 'UTF-8'); ?></textarea>
            </label>
            <button type="submit" class="cta-button">Саналаа илгээх</button>
        </form>
    </div>
</section>
<section class="about-initiative">
    <div class="container">
        <div class="about-grid">
            <div>
                <h2>Санаачилгын зорилго</h2>
                <p>Эрүүл мэндийн салбарын бодлого, үйл ажиллагаанд эмч, эмнэлгийн ажилчдын санал бодлыг системтэйгээр тусгаж, 2027 он гэхэд илүү хүртээмжтэй, хүртээмжтэй эрүүл мэндийн үйлчилгээ бий болгохыг зорьж байна.</p>
                <ul class="checklist">
                    <li>Салбарын бодит хэрэгцээг тандах</li>
                    <li>Шинэлэг, нотолгоонд суурилсан санал санаачилгыг дэмжих</li>
                    <li>Эрүүл мэндийн өгөгдөл, цахим шилжилтийг түргэвчлэх</li>
                </ul>
            </div>
            <div class="card">
                <h3>Ирэх үйл ажиллагаанууд</h3>
                <ul class="timeline">
                    <li>
                        <strong>2025.03</strong>
                        <span>Эмч, эмнэлгийн ажилчдын нээлттэй хэлэлцүүлэг</span>
                    </li>
                    <li>
                        <strong>2025.06</strong>
                        <span>Шилдэг санаачилгыг дэмжих тэтгэлэг</span>
                    </li>
                    <li>
                        <strong>2026.01</strong>
                        <span>Салбарын шинэчлэлийн тайлан, зөвлөмж</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
