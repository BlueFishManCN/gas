#!/bin/bash
help="-h"
from="-s"
if [ $# -eq 2 ]; then
    if [ $1 = $from ]; then
        if [ -d $2 ]; then
            echo "start import data."
        else
            echo "$2 is invalid dir."
            exit
        fi
    else
        echo "error, try sh import.sh -h for help."
        exit
    fi
elif [ $# -eq 1 ]; then
    if [ $1 = $help ]; then
        echo "-s [dir] | the dir of data."
        exit
    else
        echo "error, try sh import.sh -h for help."
        exit
    fi
else
    echo "error, try sh import.sh -h for help."
    exit
fi

DIR="$(cd "$(dirname "$0")" && pwd)"
echo $DIR
ASSETS="$DIR/assets"
echo $ASSETS
SHELL="$DIR/shell"
echo $SHELL
PROCESS="$DIR/process.py"
echo $PROCESS
PYTHON_PATH="/Users/zhangjiyuan/opt/anaconda3/bin/python"
echo $PYTHON_PATH

if [ -d "$2/aln/" ]; then
    echo "cp $2/aln/* to $ASSETS/aln/"
    cd $2/aln/
    cp -p * $ASSETS/aln/
    cd -
    echo "import $2/aln. done!"
else
    echo "$2/aln/ not exit."
fi

if [ -d "$2/features/samples/" ]; then
    echo "cp $2/features/samples/* to $ASSETS/family_feature/"
    cd $2/features/samples/
    cp -p * $ASSETS/family_feature/
    cd -
    echo "import $2/features/samples. done!"
else
    echo "$2/features/samples/ not exit."
fi

if [ -d "$2/hmm/" ]; then
    echo "cp $2/hmm/* to $ASSETS/hmm/"
    cd $2/hmm/
    cp -p * $ASSETS/hmm/
    cd -
    echo "import $2/hmm. done!"
else
    echo "$2/hmm/ not exit."
fi

if [ -d "$2/logo/" ]; then
    echo "cp $2/logo/* to $ASSETS/logo/"
    cd $2/logo/
    cp -p * $ASSETS/logo/
    cd -
    echo "import $2/logo. done!"
else
    echo "$2/logo/ not exit."
fi

if [ -d "$2/trees/" ]; then
    echo "cp $2/trees/* to $ASSETS/trees/"
    cd $2/trees/
    cp -p * $ASSETS/trees/
    cd -
    echo "import $2/trees. done!"
else
    echo "$2/trees/ not exit."
fi

if [ -d "$2/trees_figures/" ]; then
    echo "cp $2/trees_figures/* to $ASSETS/trees_figures/"
    cd $2/trees_figures/
    cp -p * $ASSETS/trees_figures/
    cd -
    echo "import $2/trees_figures. done!"
else
    echo "$2/trees_figures/ not exit."
fi

if [ -f "$2/AMP_country.tsv" ]; then
    echo "cp $2/AMP_country.tsv to $ASSETS/"
    cp -p $2/AMP_country.tsv $ASSETS/
else
    echo "$2/AMP_country.tsv not exit."
fi

if [ -f "$2/AMP_env.tsv" ]; then
    echo "cp $2/AMP_env.tsv to $ASSETS/"
    cp -p $2/AMP_env.tsv $ASSETS/
else
    echo "$2/AMP_env.tsv not exit."
fi

if [ -f "$2/AMP_metaG.tsv" ]; then
    echo "cp $2/AMP_metaG.tsv to $ASSETS/"
    cp -p $2/AMP_metaG.tsv $ASSETS/
else
    echo "$2/AMP_metaG.tsv not exit."
fi

if [ -f "$2/AMP_prediction.tsv" ]; then
    echo "cp $2/AMP_prediction.tsv to $ASSETS/"
    cp -p $2/AMP_prediction.tsv $ASSETS/
else
    echo "$2/AMP_prediction.tsv not exit."
fi

if [ -f "$2/features/AVG_per_family.tsv" ]; then
    echo "cp $2/features/AVG_per_family.tsv to $ASSETS/"
    cp -p $2/features/AVG_per_family.tsv $ASSETS/
else
    echo "$2/features/AVG_per_family.tsv not exit."
fi

if [ -f "$2/features/STDEV_per_family.tsv" ]; then
    echo "cp $2/features/STDEV_per_family.tsv to $ASSETS/"
    cp -p $2/features/STDEV_per_family.tsv $ASSETS/
else
    echo "$2/features/STDEV_per_family.tsv not exit."
fi

if [ -f "$2/GAS_feat_clusters.tsv" ]; then
    echo "cp $2/GAS_feat_clusters.tsv to $ASSETS/"
    cp -p $2/GAS_feat_clusters.tsv $ASSETS/
else
    echo "$2/GAS_feat_clusters.tsv not exit."
fi

# attention
if [ -f "$2/GAS.fasta" ]; then
    echo "cp $2/GAS.fasta to $SHELL/ampdb/"
    cp -p $2/GAS.fasta $SHELL/ampdb/
else
    echo "$2/GAS.fasta not exit."
fi

if [ -d "$2/blastdb/" ]; then
    echo "cp $2/blastdb/* to $SHELL/blastdb/"
    cd $2/blastdb/
    cp -p * $SHELL/blastdb/
    cd -
    echo "import $2/blastdb. done!"
else
    echo "$2/blastdb not exit."
fi

# attention
if [ -d "$2/hmmerdb/" ]; then
    echo "cp $2/hmmerdb/* to $SHELL/hmmerdb/"
    cd $2/hmmerdb/
    cp -p * $SHELL/hmmerdb/
    cd -
    echo "import $2/hmmerdb. done!"
else
    echo "$2/hmmerdb not exit."
fi

cd $DIR
$PYTHON_PATH process.py && echo "DONE!"
