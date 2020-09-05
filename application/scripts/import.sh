#!/bin/bash

 if [ -d "/data/data/aln/" ];then
   echo "cp /data/data/aln/* to /opt/lampp/htdocs/gas/assets/aln/"
   cp -p /data/data/aln/* /opt/lampp/htdocs/gas/assets/aln/
   echo "[5%]:done!"
 else
   echo "/data/data/aln/ not exit."
 fi

 if [ -d "/data/data/features/samples/" ];then
   echo "cp /data/data/features/samples/* to /opt/lampp/htdocs/gas/assets/family_feature/"
   cp -p /data/data/features/samples/* /opt/lampp/htdocs/gas/assets/family_feature/
   echo "[10%]:done!"
 else
   echo "/data/data/features/samples/ not exit."
 fi

 if [ -d "/data/data/hmm/" ];then
   echo "cp /data/data/hmm/* to /opt/lampp/htdocs/gas/assets/hmm/"
   cp -p /data/data/hmm/* /opt/lampp/htdocs/gas/assets/hmm/
   echo "[15%]:done!"
 else
   echo "/data/data/hmm/ not exit."
 fi

 if [ -d "/data/data/logo/" ];then
   echo "cp /data/data/logo/* to /opt/lampp/htdocs/gas/assets/logo/"
   cp -p /data/data/logo/* /opt/lampp/htdocs/gas/assets/logo/
   echo "[20%]:done!"
 else
   echo "/data/data/logo/ not exit."
 fi

 if [ -d "/data/data/trees/" ];then
   echo "cp /data/data/trees/* to /opt/lampp/htdocs/gas/assets/trees/"
   cp -p /data/data/trees/* /opt/lampp/htdocs/gas/assets/trees/
   echo "[25%]:done!"
 else
   echo "/data/data/trees/ not exit."
 fi

 if [ -d "/data/data/trees_figures/" ];then
   echo "cp /data/data/trees_figures/* to /opt/lampp/htdocs/gas/assets/trees_figures/"
   cp -p /data/data/trees_figures/* /opt/lampp/htdocs/gas/assets/trees_figures/
   echo "[30%]:done!"
 else
   echo "/data/data/trees_figures/ not exit."
 fi

python