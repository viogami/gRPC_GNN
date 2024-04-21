<?php
// GENERATED CODE -- DO NOT EDIT!

namespace GCN;

/**
 */
class GCNServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \GCN\GCNRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function ProcessGCN(\GCN\GCNRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/GCNService/ProcessGCN',
        $argument,
        ['\GCN\GCNResult', 'decode'],
        $metadata, $options);
    }

}
