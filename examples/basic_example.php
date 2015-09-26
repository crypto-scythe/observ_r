<?php

require( '../src/subject.php' );
require( '../src/observer.php' );

class testSubject {

  use crypto_scythe\Observ_r\Subject;

  public function testObservers() {

    echo 'Notifying attached observers' . PHP_EOL;
    $this->subjectNotify( array( 'code' => true, 'text' => 'Lorem Ipsum dolor...' ) );

  }

}

class testObserverCode {

  use crypto_scythe\Observ_r\Observer;

  public function __construct( $subject ) {

    $this->observerAttach( $subject, 'operate' );

  }

  public function operate( $data ) {

    var_dump( $data['code'] );

  }

}

class testObserverText {

  use crypto_scythe\Observ_r\Observer;

  public function __construct( $subject ) {

    $this->observerAttach( $subject, 'operation' );

  }

  public function operation( $data ) {

    var_dump( $data['text'] );

  }

}

$subject = new testSubject();
$observerText = new testObserverText( $subject );
$observerCode = new testObserverCode( $subject );

$subject->testObservers();
// Each observer reacts to the update

// Detach the first observer (Text)
$observerText->observerDetach( $subject );

$subject->testObservers();
// Now only the remaining observer reacts (Code)
