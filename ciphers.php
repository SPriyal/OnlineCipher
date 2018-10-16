<?php include'header.php'; ?>
<!-- Main -->
        <header class="major">
            <h2>Ciphers & Algorithms</h2>
            <p>Select any cipher/Algorithm to get Started! </p>
        </header>
        <div class="container">
            <div class="row">
                <div class="4u">
                    <section>
                        <h3>Ciphers</h3>
                        <ul class="alt">
                            <?php echo getCipherList(); ?>
                        </ul>
                    </section>
                </div>
                <div class="4u">
                    <section>
                        <h3>Algorithms</h3>
                        <ul class="alt">
                            <?php echo getAlgoList(); ?>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
<?php include'footer.php'; ?>