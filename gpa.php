<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حساب المعدل - دليل الطالب الجامعي</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1>حساب المعدل</h1>
        <button class="theme-toggle" onclick="toggleTheme()">تبديل الوضع</button>
        <nav> <!--شريط التنقل-->
            <a href="#">الرئيسية</a>
            <a href="#">عن الجامعة</a>
            <a href="#">الخريطة</a>
            <a href="#">تواصل بنا</a>
            <!-- زر تسجيل الدخول مع أيقونة -->
            <div class="login-container">
                <button onclick="openLoginModal()" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>تسجيل الدخول</span>
                </button>
            </div>
        </nav>
    </header>

    <main>
        <section class="gpa-calc">
            <!-- Form to select the number of subjects -->
            <form action="gpa.php" method="post">
                <div class="form-group">
                    <label>عدد المواد:</label>
                    <select id="subjectCount" name="subjectCount" onchange="this.form.submit()">
                        <option value="">اختر عدد المواد</option>
                        <?php
                        for ($i = 1; $i <= 7; $i++) {
                            // Preserve the selection on reload
                            $selected = (isset($_POST['subjectCount']) && $_POST['subjectCount'] == $i) ? 'selected' : '';
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                </div>
            </form>

            <!-- Form to enter grades and hours -->
            <form action="gpa.php" method="post">
                <?php
                if (isset($_POST['subjectCount'])) {
                    $subjectCount = $_POST['subjectCount'];
                    echo "<input type='hidden' name='subjectCount' value='$subjectCount'>";
                    for ($i = 1; $i <= $subjectCount; $i++) {
                        echo "<div class='form-group'>
                            <label>المادة $i:</label>
                            <input type='number' name='grade$i' placeholder='درجة المادة (0 - 100)' min='0' max='100' required>
                            <input type='number' name='hours$i' placeholder='عدد الساعات' min='1' required>
                          </div>";
                    }
                    echo "<button type='submit' name='calculate'>حساب المعدل</button>";
                }
                ?>
            </form>

            <?php
            if (isset($_POST['calculate'])) {
                $subjectCount = $_POST['subjectCount'];
                $totalPoints = 0;
                $totalHours = 0;

                for ($i = 1; $i <= $subjectCount; $i++) {
                    $grade = floatval($_POST["grade$i"]);
                    $hours = floatval($_POST["hours$i"]);

                    // تحويل الدرجة إلى نقاط
                    if ($grade >= 90)
                        $points = 4.0;
                    elseif ($grade >= 80)
                        $points = 3.0;
                    elseif ($grade >= 70)
                        $points = 2.0;
                    elseif ($grade >= 60)
                        $points = 1.0;
                    else
                        $points = 0;

                    $totalPoints += $points * $hours;
                    $totalHours += $hours;
                }

                if ($totalHours > 0) {
                    $gpa = $totalPoints / $totalHours;
                    echo "<div class='result'>المعدل الفصلي: " . number_format($gpa, 2) . " / 4.0</div>";
                }
            }
            ?>
        </section>
    </main>

    <footer>
        <p>2025 © جميع الحقوق محفوظة - جامعة الطائف</p>
    </footer>

    <script src="script.js"></script>
</body>

</html>