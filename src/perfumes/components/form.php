<?php
function generateForm($action, $inputs, $titleForm, $valueButton) {
    echo '<div class="p-3">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">' . htmlspecialchars($titleForm) . '</h4>
                <form action="' . "../business_logic/" . htmlspecialchars($action) . '" method="post" id="form" enctype="multipart/form-data">
                <div class="row">';

    foreach ($inputs as $input) {
        $label = htmlspecialchars($input['label']);
        $name = htmlspecialchars($input['name']);
        $type = htmlspecialchars($input['type']);
        $col = isset($input['col']) ? htmlspecialchars($input['col']) : 'col-md-12';

        echo '<div class="mb-2 ' . $col . '">
                <label for="' . $name . '" class="form-label">' . $label . '</label>';

        // por si es de tipo select u otro
        if ($type === 'select') {
            echo '<select class="form-select" id="' . $name . '" name="' . $name . '" required>';
            
            echo '<option value="" disabled selected>Seleccione una opción</option>';
            if (isset($input['options']) && is_array($input['options'])) {
                foreach ($input['options'] as $option) {
                    echo '<option value="' . htmlspecialchars($option) . '">' . htmlspecialchars($option) . '</option>';
                }
            }
            
            echo '</select>';
        }
        
         else {
            echo '<input type="' . $type . '" class="form-control" id="' . $name . '" name="' . $name . '" placeholder="' . $label . '" required>';
        }

        echo '</div>';
    }

    echo '</div>'; 

    echo '<button type="submit" class="btn btn-primary mt-4">' . htmlspecialchars($valueButton) . '</button>
                </form>
            </div>
        </div>
    </div>';
}
?>
