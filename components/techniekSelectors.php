            <select class="form-control" name="technieken[]" id="projectTechniek1" class="techniekSelector" required>
                <?php
                echo "<option value='null'>techniek 1</option>";
                foreach ($technieken as $val => $value) {
                    echo "<option value='$value[techniek]'>$value[techniek]</option>";
                }
                ?>
            </select>
            <select class="form-control" name="technieken[]" id="projectTechniek2" class="techniekSelector">
                <?php
                echo "<option value='null'>techniek 2</option>";
                foreach ($technieken as $val => $value) {
                    echo "<option value='$value[techniek]'>$value[techniek]</option>";
                }
                ?>
            </select>
            <select class="form-control" name="technieken[]" id="projectTechniek3" class="techniekSelector">
                <?php
                echo "<option value='null'>techniek 3</option>";
                foreach ($technieken as $val => $value) {
                    echo "<option value='$value[techniek]'>$value[techniek]</option>";
                }
                ?>
            </select>
