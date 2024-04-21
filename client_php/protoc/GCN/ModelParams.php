<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: gcn.proto

namespace GCN;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>ModelParams</code>
 */
class ModelParams extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 input_dims = 1;</code>
     */
    protected $input_dims = 0;
    /**
     * Generated from protobuf field <code>int32 hidden_dims = 2;</code>
     */
    protected $hidden_dims = 0;
    /**
     * Generated from protobuf field <code>int32 output_dims = 3;</code>
     */
    protected $output_dims = 0;
    /**
     * Generated from protobuf field <code>int32 iterations = 4;</code>
     */
    protected $iterations = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $input_dims
     *     @type int $hidden_dims
     *     @type int $output_dims
     *     @type int $iterations
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Gcn::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>int32 input_dims = 1;</code>
     * @return int
     */
    public function getInputDims()
    {
        return $this->input_dims;
    }

    /**
     * Generated from protobuf field <code>int32 input_dims = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setInputDims($var)
    {
        GPBUtil::checkInt32($var);
        $this->input_dims = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 hidden_dims = 2;</code>
     * @return int
     */
    public function getHiddenDims()
    {
        return $this->hidden_dims;
    }

    /**
     * Generated from protobuf field <code>int32 hidden_dims = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setHiddenDims($var)
    {
        GPBUtil::checkInt32($var);
        $this->hidden_dims = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 output_dims = 3;</code>
     * @return int
     */
    public function getOutputDims()
    {
        return $this->output_dims;
    }

    /**
     * Generated from protobuf field <code>int32 output_dims = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setOutputDims($var)
    {
        GPBUtil::checkInt32($var);
        $this->output_dims = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 iterations = 4;</code>
     * @return int
     */
    public function getIterations()
    {
        return $this->iterations;
    }

    /**
     * Generated from protobuf field <code>int32 iterations = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setIterations($var)
    {
        GPBUtil::checkInt32($var);
        $this->iterations = $var;

        return $this;
    }

}
