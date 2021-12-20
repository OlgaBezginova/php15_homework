<?php

class Polygon {

    protected $_angles;

    public function setAngles( $angles = [] ) {
        if( ! is_array( $angles ) ) {
            $angles = [];
        }

        $angles_num = count( $angles );

        if ( $angles_num > 2 ){
            $angles_sum = 0;
            foreach( $angles as $angle ) {
                $angles_sum += $angle;
            }
            if ( $angles_sum == 180 * ( $angles_num -2 ) ) {
                $this->_angles = $angles;
            }
        }
    }

    public function getAngles() {
        return $this->_angles;
    }

    public function __toString() {
        if ( ! empty( $this->_angles ) ) {
            return "This is a " . get_class($this) . ":\n angles: " . count( $this->_angles ) . "\n";
        } else {
            return "This is not a " . get_class($this) . "\n";
        }
    }

}

class Rectangle extends Polygon {

    protected $_edgeA, $_edgeB;

    public function setAngles( $angles = [] ) {
        parent::setAngles( [90, 90, 90, 90] );
    }

    public function setEdges( $a = 0, $b = 0 ) {
        if( ! is_numeric( $a ) || $a < 0 ) {
            $a = 0;
        }

        if( ! is_numeric( $b ) || $b < 0 ) {
            $b = 0;
        }

        if( empty( $this->_angles ) ) {
            $this->setAngles();
        }

        $this->_edgeA = $a;
        $this->_edgeB = $b;
    }

    public function getEdges() {
        return [$this->_edgeA, $this->_edgeB];
    }

    public function perimeter() {
        return 2 * ( $this->_edgeA + $this->_edgeB );
    }

    public function area() {
        return $this->_edgeA * $this->_edgeB;
    }

    public function __toString() {
        return parent::__toString($this) . " side A = $this->_edgeA\n side B = $this->_edgeB\n perimeter = {$this->perimeter()}\n area = {$this->area()}\n";
    }

}

class Square extends Rectangle {

    public function setEdges( $a = 0, $b = 0 ) {
        parent::setEdges( $a, $a );
    }

    public function perimeter() {
        return 4 * $this->_edgeA;
    }

    public function area() {
        return $this->_edgeA * $this->_edgeA;
    }
}

$polygon = new Polygon();
$polygon->setAngles( [90, 45, 45] );
echo $polygon;

$rectangle = new Rectangle();
$rectangle->setEdges( 6, 8 );
echo $rectangle;

$square = new Square();
$square->setEdges( 7 );
echo $square;