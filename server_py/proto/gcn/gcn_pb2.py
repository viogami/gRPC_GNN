# -*- coding: utf-8 -*-
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: gcn.proto
# Protobuf Python Version: 4.25.1
"""Generated protocol buffer code."""
from google.protobuf import descriptor as _descriptor
from google.protobuf import descriptor_pool as _descriptor_pool
from google.protobuf import symbol_database as _symbol_database
from google.protobuf.internal import builder as _builder
# @@protoc_insertion_point(imports)

_sym_db = _symbol_database.Default()




DESCRIPTOR = _descriptor_pool.Default().AddSerializedFile(b'\n\tgcn.proto\"$\n\x04Node\x12\n\n\x02id\x18\x01 \x01(\t\x12\x10\n\x08\x66\x65\x61tures\x18\x02 \x03(\x02\",\n\x04\x45\x64ge\x12\x11\n\tsource_id\x18\x01 \x01(\t\x12\x11\n\ttarget_id\x18\x02 \x01(\t\"7\n\tGraphData\x12\x14\n\x05nodes\x18\x01 \x03(\x0b\x32\x05.Node\x12\x14\n\x05\x65\x64ges\x18\x02 \x03(\x0b\x32\x05.Edge\"_\n\x0bModelParams\x12\x12\n\ninput_dims\x18\x01 \x01(\x05\x12\x13\n\x0bhidden_dims\x18\x02 \x01(\x05\x12\x13\n\x0boutput_dims\x18\x03 \x01(\x05\x12\x12\n\niterations\x18\x04 \x01(\x05\"+\n\x0bHistoryData\x12\x1c\n\tyear_data\x18\x01 \x03(\x0b\x32\t.YearData\"8\n\x08YearData\x12\x0c\n\x04year\x18\x01 \x01(\x05\x12\x1e\n\nplace_data\x18\x02 \x03(\x0b\x32\n.PlaceData\"U\n\tPlaceData\x12\r\n\x05place\x18\x01 \x01(\t\x12\x11\n\tlongitude\x18\x02 \x01(\x01\x12\x10\n\x08latitude\x18\x03 \x01(\x01\x12\x14\n\x0ctotal_people\x18\x04 \x01(\x05\"i\n\nGCNRequest\x12\x19\n\x05graph\x18\x01 \x01(\x0b\x32\n.GraphData\x12\x1c\n\x06params\x18\x02 \x01(\x0b\x32\x0c.ModelParams\x12\"\n\x0chistory_data\x18\x03 \x01(\x0b\x32\x0c.HistoryData\"}\n\tGCNResult\x12/\n\x0bnode_scores\x18\x01 \x03(\x0b\x32\x1a.GCNResult.NodeScoresEntry\x12\x0c\n\x04loss\x18\x02 \x01(\x05\x1a\x31\n\x0fNodeScoresEntry\x12\x0b\n\x03key\x18\x01 \x01(\t\x12\r\n\x05value\x18\x02 \x01(\x02:\x02\x38\x01\x32\x33\n\nGCNService\x12%\n\nProcessGCN\x12\x0b.GCNRequest\x1a\n.GCNResultb\x06proto3')

_globals = globals()
_builder.BuildMessageAndEnumDescriptors(DESCRIPTOR, _globals)
_builder.BuildTopDescriptorsAndMessages(DESCRIPTOR, 'gcn_pb2', _globals)
if _descriptor._USE_C_DESCRIPTORS == False:
  DESCRIPTOR._options = None
  _globals['_GCNRESULT_NODESCORESENTRY']._options = None
  _globals['_GCNRESULT_NODESCORESENTRY']._serialized_options = b'8\001'
  _globals['_NODE']._serialized_start=13
  _globals['_NODE']._serialized_end=49
  _globals['_EDGE']._serialized_start=51
  _globals['_EDGE']._serialized_end=95
  _globals['_GRAPHDATA']._serialized_start=97
  _globals['_GRAPHDATA']._serialized_end=152
  _globals['_MODELPARAMS']._serialized_start=154
  _globals['_MODELPARAMS']._serialized_end=249
  _globals['_HISTORYDATA']._serialized_start=251
  _globals['_HISTORYDATA']._serialized_end=294
  _globals['_YEARDATA']._serialized_start=296
  _globals['_YEARDATA']._serialized_end=352
  _globals['_PLACEDATA']._serialized_start=354
  _globals['_PLACEDATA']._serialized_end=439
  _globals['_GCNREQUEST']._serialized_start=441
  _globals['_GCNREQUEST']._serialized_end=546
  _globals['_GCNRESULT']._serialized_start=548
  _globals['_GCNRESULT']._serialized_end=673
  _globals['_GCNRESULT_NODESCORESENTRY']._serialized_start=624
  _globals['_GCNRESULT_NODESCORESENTRY']._serialized_end=673
  _globals['_GCNSERVICE']._serialized_start=675
  _globals['_GCNSERVICE']._serialized_end=726
# @@protoc_insertion_point(module_scope)
