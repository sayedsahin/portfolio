<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-7">
        <form id="contactForm" method="post" action="<?= BASE_URL; ?>/contact">
            <?= csrf_field() ?>
            <!-- Name input-->
            <div class="form-floating mb-3">
                <input name="name" class="form-control" id="name" type="text" placeholder="Enter your name..." required />
                <label for="name">Full name*</label>
            </div>
            <!-- Email address input-->
            <div class="form-floating mb-3">
                <input name="email" class="form-control" id="email" type="email" placeholder="name@example.com" required />
                <label for="email">Email address*</label>
            </div>
            <!-- Phone number input-->
            <div class="form-floating mb-3">
                <input name="phone" class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" />
                <label for="phone">Phone number (optional)</label>
            </div>
            <!-- Message input-->
            <div class="form-floating mb-3">
                <textarea name="body" class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem"></textarea>
                <label for="message">Message*</label>
            </div>
            <div class="mb-3">
                <label for="captcha_answer" class="form-label text-secondary">Security Check</label>

                <div class="input-group">
                    <span class="input-group-text p-0 overflow-hidden bg-light border-end-0">
                        <canvas id="captchaCanvas" width="100" height="38"></canvas>
                    </span>

                    <input type="number"
                        id="captcha_answer"
                        name="captcha_answer"
                        class="form-control w-25"
                        required
                        autocomplete="off"
                        placeholder="Enter the answer"
                        aria-describedby="captcha-addon">
                </div>
            </div>

            <div id="submitMessage">
                <?= flash(); ?>
            </div>
            <!-- Submit Button-->
            <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Send</button>
        </form>
    </div>
</div>
<script>

    const canvas = document.getElementById('captchaCanvas');
const ctx = canvas.getContext('2d');

ctx.fillStyle = '#f8f9fa';
ctx.fillRect(0, 0, canvas.width, canvas.height);

ctx.font = 'bold 18px sans-serif';
ctx.fillStyle = '#051e45'; // Bootstrap Primary Color
ctx.fillText("<?= $captchaQuestion ?>", 10, 24);

ctx.strokeStyle = '#ced4da';
ctx.beginPath();
ctx.moveTo(5, 5); ctx.lineTo(95, 30);
ctx.stroke();
</script>
