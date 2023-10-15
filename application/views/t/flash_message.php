<div class="container-fluid">
  <?php
  if ($this->session->flashdata('msg_danger')) {
    echo "<div class='alert alert-danger'>" . $this->session->flashdata('msg_danger') . "</div>";
  } else if ($this->session->flashdata('msg_success')) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>" . $this->session->flashdata('msg_success') . "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
</div>";
  } else if ($this->session->flashdata('msg_info')) {
    echo "<div class='alert alert-info'>" . $this->session->flashdata('msg_info') . "</div>";
  }

  if (validation_errors()) {
    echo "<div class='alert alert-danger'>" . validation_errors() . "</div>";
  }
  ?>
</div>