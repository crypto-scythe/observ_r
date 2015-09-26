<?php

namespace crypto_scythe\Observ_r;

/*
 * Observ_r\Observer is an implementation of the observer pattern
 *
 * The observer can attach itself to multiple subjects to be informed about
 * their changes, additionally it can respond with a different method per
 * subject
 *
 * @access    public
 * @author    Chris Fasel <crypto.scythe@gmail.com>
 * @copyright Copyright (c) 2015, Chris Fasel
 * @license   http://opensource.org/licenses/MIT
 *
 */

trait Observer {

  protected $observerSubjects = array();

  public function observerUpdate( $subject, $data ) {

    foreach( $this->observerSubjects as $stored_subject ) {

      if( $subject === $stored_subject['subject'] ) {

        // Only public methods for now
        call_user_func( array( $this, $stored_subject['callback'] ), $data );

      }

    }

  }

  public function observerAttach( $subject, $callback ) {

    $subject->subjectAttach( $this );
    $this->observerSubjects[] = array(
      'subject' => $subject,
      'callback' => $callback
    );

  }

  public function observerDetach( $subject ) {

    $subject->subjectDetach( $this );

    foreach( $this->observerSubjects as $index => $stored_subject ) {

      if( $subject === $stored_subject['subject'] ) {

        unset( $this->observerSubjects[$index] );

      }

    }

  }

}
