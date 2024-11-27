<?php

/**
 * @var App\Views\IndexView $this
 * @see \App\Controllers\IndexController::chartAjaxAction()
 */

?>
<div class="toolbar">
    <form>
        <label for="grid_size">Grid size</label>
        <input
            type="number"
            min="3"
            max="20"
            id="grid_size"
            name="grid_size"
            value="<?= $this->gridSize ?>"
        />
        <input type="submit" value="Play">
    </form>
</div>

<div class="row content-container col-xs-12">
    <div id="game_grid_container">
        <table id="game_grid">
            <?php for ($row = 1; $row <= $this->gridSize; $row++) { ?>
                <tr>
                    <?php
                        for ($col = 1; $col <= $this->gridSize; $col++) {
                            $button_id = 'game_grid_' . $row . '_' . $col;
                            ?>
                        <td>
                            <button id="<?= $button_id ?>" onclick="makeMove('<?= $button_id ?>')"></button>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
