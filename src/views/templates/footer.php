<?php
/**
 * footer.php
 * Example footer partial template.
 * 
 * Params:
 * - assets : App. static assets names
 */
?>

  </main>
  <footer>
    <h5>Example footer text</h5>
  </footer>
<?php if (isset($assets)): ?>
  <script src="<?=$assets->{VENDOR_JS_BUNDLE}?>"></script>
  <script src="<?=$assets->{MAIN_JS_BUNDLE}?>"></script>
<?php endif; ?>
</body>
</html>