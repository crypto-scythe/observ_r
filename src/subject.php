<?php

namespace crypto_scythe\Observ_r;

/*
 * Observ_r\Subject is an implementation of the observer pattern
 *
 * The observers can attach to the subject to be informed on updates and detach
 * themself if needed
 *
 * @access    public
 * @author    Chris Fasel <crypto.scythe@gmail.com>
 * @copyright Copyright (c) 2015, Chris Fasel
 * @license   http://opensource.org/licenses/MIT
 *
 */

trait Subject {

  protected $subjectObservers = array();

  public function subjectAttach( $observer ) {

    $this->subjectObservers[] = $observer;

  }

  public function subjectDetach( $observer ) {

    foreach( $this->subjectObservers as $index => $storedObserver ) {

      if( $storedObserver === $observer ) {

        unset( $this->subjectObservers[$index] );

      }

    }

  }

  protected function subjectNotify( $data ) {

    foreach( $this->subjectObservers as $observer ) {

      $observer->observerUpdate( $this, $data );

    }

  }

}
