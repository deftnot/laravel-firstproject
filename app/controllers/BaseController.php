<?php

class BaseController extends Controller {

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    /**
     * Validate image size and extension
     * @param File $file     
     * return Bool
     */
    protected function imageValidation($file) {
        $ext = $file->getClientOriginalExtension();
        if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif') {
            return true;
        }
        return false;
    }        

}