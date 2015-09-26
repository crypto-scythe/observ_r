# Obsrv_r

Dynamic Observer Pattern via PHP Traits with observers to react differently to specific subject update notices

## Installing

File **composer.json**

    {
      "require": {
        "crypto_scythe/observ_r": "*"
      }
    }

Then on command line:

    composer install

## Usage (simliar to examples/basic_example.php)

    <?php

    require( 'vendor/autoload.php' );

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

    ?>
