#!/usr/bin/python
# -*- coding: UTF-8 -*-

import os
import MySQLdb
import numpy as np
import pandas as pd

db = MySQLdb.connect("127.0.0.1", "root", "", "gas", charset='utf8')

if os.path.exists('assets/GAS.fasta'):
    cursor = db.cursor()
    sql = "INSERT INTO amp_family(AMP_ID,Family_ID,Sequence,Length) VALUES (%s, %s, %s, %s) ON DUPLICATE KEY UPDATE AMP_ID=values(AMP_ID),Family_ID=values(Family_ID),Sequence=values(Sequence),Length=values(Length);"

    f = open('assets/GAS.fasta')
    output = []
    temp = []
    for line in f:
        if line.startswith('>'):
            temp = line.replace('>', '').split('|')
            temp[1] = temp[1].replace('\n', '')
        else:
            line = line.replace('\n', '')
            temp.append(line)
            temp.append(len(line))
            output.append(temp)

    try:
        cursor.executemany(sql, output)
        db.commit()
        print('Done! Import GAS.fasta to the gas database.')
    except:
        db.rollback()
        print('Error! Import GAS.fasta to the gas database.')

if os.path.exists('assets/AMP_env.tsv'):
    cursor = db.cursor()
    sql = "INSERT INTO amp_environment(AMP_ID,Freshwater,Gut,Marine,Milk,Oral_Cavity,Respiratory_Tract,Skin,Soil,Surface,Vagina,Wastewater) VALUES (%s, %s, %s,%s, %s, %s,%s, %s, %s,%s, %s,%s) ON DUPLICATE KEY UPDATE AMP_ID=values(AMP_ID),Freshwater=values(Freshwater),Gut=values(Gut),Marine=values(Marine),Milk=values(Milk),Oral_Cavity=values(Oral_Cavity),Respiratory_Tract=values(Respiratory_Tract),Skin=values(Skin),Soil=values(Soil),Surface=values(Surface),Vagina=values(Vagina),Wastewater=values(Wastewater);"
    data = pd.read_csv('assets/AMP_env.tsv', sep='\t', index_col=False)
    data = data.values.tolist()

    try:
        cursor.executemany(sql, data)
        db.commit()
        print('Done! Import AMP_env.tsv to the gas database.')
    except:
        db.rollback()
        print('Error! Import AMP_env.tsv to the gas database.')

if os.path.exists('assets/GAS_feat_clusters.tsv'):
    cursor = db.cursor()
    sql = "INSERT INTO amp_feature(AMP_ID,Sequence,tinyAA,smallAA,aliphaticAA,aromaticAA,nonpolarAA,polarAA,chargedAA,basicAA,acidicAA,charge,pI,aindex,instaindex,boman,hydrophobicity,hmoment,SA_Group1_residue0,SA_Group2_residue0,SA_Group3_residue0,HB_Group1_residue0,HB_Group2_residue0,HB_Group3_residue0,AGG,AMYLO,TURN,HELIX,HELAGG,BETA,Level_I,Level_II,Level_III,Length) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s) ON DUPLICATE KEY UPDATE AMP_ID=values(AMP_ID),Sequence=values(Sequence),tinyAA=values(tinyAA),smallAA=values(smallAA),aliphaticAA=values(aliphaticAA),aromaticAA=values(aromaticAA),nonpolarAA=values(nonpolarAA),polarAA=values(polarAA),chargedAA=values(chargedAA),basicAA=values(basicAA),acidicAA=values(acidicAA),charge=values(charge),pI=values(pI),aindex=values(aindex),instaindex=values(instaindex),boman=values(boman),hydrophobicity=values(hydrophobicity),hmoment=values(hmoment),SA_Group1_residue0=values(SA_Group1_residue0),SA_Group2_residue0=values(SA_Group2_residue0),SA_Group3_residue0=values(SA_Group3_residue0),HB_Group1_residue0=values(HB_Group1_residue0),HB_Group2_residue0=values(HB_Group2_residue0),HB_Group3_residue0=values(HB_Group3_residue0),AGG=values(AGG),AMYLO=values(AMYLO),TURN=values(TURN),HELIX=values(HELIX),HELAGG=values(HELAGG),BETA=values(BETA),Level_I=values(Level_I),Level_II=values(Level_II),Level_III=values(Level_III),Length=values(Length);"

    data = pd.read_csv('assets/GAS_feat_clusters.tsv',
                       sep='\t', index_col=False)
    length = []
    for i in data.index:
        length.append(len(data.loc[i]['Sequence']))
    data['Length'] = length
    data = data.values.tolist()

    try:
        cursor.executemany(sql, data)
        db.commit()
        print('Done! Import GAS_feat_clusters.tsv to the gas database.')
    except:
        db.rollback()
        print('Error! Import GAS_feat_clusters.tsv to the gas database.')

if os.path.exists('assets/AMP_prediction.tsv'):
    cursor = db.cursor()
    sql = "INSERT INTO amp_prediction(AMP_ID,AMP_Class,AMP_Probability,Hemolysis_Class,Hemolysis_Probability) VALUES (%s, %s, %s, %s, %s) ON DUPLICATE KEY UPDATE AMP_ID=values(AMP_ID),AMP_Class=values(AMP_Class),AMP_Probability=values(AMP_Probability),Hemolysis_Class=values(Hemolysis_Class),Hemolysis_Probability=values(Hemolysis_Probability);"
    data = pd.read_csv('assets/AMP_prediction.tsv', sep='\t', index_col=False)
    data = data.values.tolist()

    try:
        cursor.executemany(sql, data)
        db.commit()
        print('Done! Import AMP_prediction.tsv to the gas database.')
    except:
        db.rollback()
        print('Error! Import AMP_prediction.tsv to the gas database.')

if os.path.exists('assets/AMP_metaG.tsv'):
    cursor = db.cursor()
    sql = "INSERT INTO amp_metagenome(AMP_ID,metagenomes) VALUES (%s, %s) ON DUPLICATE KEY UPDATE AMP_ID=values(AMP_ID);"
    data = pd.read_csv('assets/AMP_metaG.tsv', sep='\t',
                       index_col=False, header=None)
    output = []
    for i in data.index:
        temp = data.loc[i][1].split(',')
        temp = np.array(temp)
        for j in range(temp.size):
            output.append([data.loc[i][0], temp[j]])

    try:
        cursor.executemany(sql, output)
        db.commit()
        print('Done! Import AMP_metaG.tsv to the gas database.')
    except:
        db.rollback()
        print('Error! Import AMP_metaG.tsv to the gas database.')

if os.path.exists('assets/AMP_country.tsv'):
    cursor = db.cursor()
    sql = "INSERT INTO amp_country(AMP_ID,Africa, Asia, Europe,na,New_Zaeland,North_America,Oceania,Pacific_Ocean,South_America) VALUES (%s, %s, %s,%s, %s, %s,%s, %s, %s,%s) ON DUPLICATE KEY UPDATE Africa=values(Africa), Asia=values(Asia), Europe=values(Europe),na=values(na),New_Zaeland=values(New_Zaeland),North_America=values(North_America),Oceania=values(Oceania),Pacific_Ocean=values(Pacific_Ocean),South_America=values(South_America);"
    data = pd.read_csv('assets/AMP_country.tsv', sep='\t', index_col=False)
    data = data.values.tolist()

    try:
        cursor.executemany(sql, data)
        db.commit()
        print('Done! Import AMP_country.tsv to the gas database.')
    except:
        db.rollback()
        print('Error! Import AMP_country.tsv to the gas database.')

if os.path.exists('assets/AVG_per_family.tsv'):
    cursor = db.cursor()
    sql = "INSERT INTO family_avg_feature(Family_ID,tinyAA,smallAA,aliphaticAA,aromaticAA,nonpolarAA,polarAA,chargedAA,basicAA,acidicAA,charge,pI,aindex,instaindex,boman,hydrophobicity,hmoment,SA_Group1_residue0,SA_Group2_residue0,SA_Group3_residue0,HB_Group1_residue0,HB_Group2_residue0,HB_Group3_residue0,AGG,AMYLO,TURN,HELIX,HELAGG,BETA) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s) ON DUPLICATE KEY UPDATE Family_ID=values(Family_ID),tinyAA=values(tinyAA),smallAA=values(smallAA),aliphaticAA=values(aliphaticAA),aromaticAA=values(aromaticAA),nonpolarAA=values(nonpolarAA),polarAA=values(polarAA),chargedAA=values(chargedAA),basicAA=values(basicAA),acidicAA=values(acidicAA),charge=values(charge),pI=values(pI),aindex=values(aindex),instaindex=values(instaindex),boman=values(boman),hydrophobicity=values(hydrophobicity),hmoment=values(hmoment),SA_Group1_residue0=values(SA_Group1_residue0),SA_Group2_residue0=values(SA_Group2_residue0),SA_Group3_residue0=values(SA_Group3_residue0),HB_Group1_residue0=values(HB_Group1_residue0),HB_Group2_residue0=values(HB_Group2_residue0),HB_Group3_residue0=values(HB_Group3_residue0),AGG=values(AGG),AMYLO=values(AMYLO),TURN=values(TURN),HELIX=values(HELIX),HELAGG=values(HELAGG),BETA=values(BETA);"
    data = pd.read_csv('assets/AVG_per_family.tsv', sep='\t', index_col=False)
    data = data.values.tolist()

    try:
        cursor.executemany(sql, data)
        db.commit()
        print('Done! Import AVG_per_family.tsv to the gas database.')
    except:
        db.rollback()
        print('Error! Import AVG_per_family.tsv to the gas database.')

if os.path.exists('assets/STDEV_per_family.tsv'):
    cursor = db.cursor()
    sql = "INSERT INTO family_std_feature(Family_ID,tinyAA,smallAA,aliphaticAA,aromaticAA,nonpolarAA,polarAA,chargedAA,basicAA,acidicAA,charge,pI,aindex,instaindex,boman,hydrophobicity,hmoment,SA_Group1_residue0,SA_Group2_residue0,SA_Group3_residue0,HB_Group1_residue0,HB_Group2_residue0,HB_Group3_residue0,AGG,AMYLO,TURN,HELIX,HELAGG,BETA) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s) ON DUPLICATE KEY UPDATE Family_ID=values(Family_ID),tinyAA=values(tinyAA),smallAA=values(smallAA),aliphaticAA=values(aliphaticAA),aromaticAA=values(aromaticAA),nonpolarAA=values(nonpolarAA),polarAA=values(polarAA),chargedAA=values(chargedAA),basicAA=values(basicAA),acidicAA=values(acidicAA),charge=values(charge),pI=values(pI),aindex=values(aindex),instaindex=values(instaindex),boman=values(boman),hydrophobicity=values(hydrophobicity),hmoment=values(hmoment),SA_Group1_residue0=values(SA_Group1_residue0),SA_Group2_residue0=values(SA_Group2_residue0),SA_Group3_residue0=values(SA_Group3_residue0),HB_Group1_residue0=values(HB_Group1_residue0),HB_Group2_residue0=values(HB_Group2_residue0),HB_Group3_residue0=values(HB_Group3_residue0),AGG=values(AGG),AMYLO=values(AMYLO),TURN=values(TURN),HELIX=values(HELIX),HELAGG=values(HELAGG),BETA=values(BETA);"
    data = pd.read_csv('assets/STDEV_per_family.tsv',
                       sep='\t', index_col=False)
    data = data.values.tolist()

    try:
        cursor.executemany(sql, data)
        db.commit()
        print('Done! Import STDEV_per_family.tsv to the gas database.')
    except:
        db.rollback()
        print('Error! Import STDEV_per_family.tsv to the gas database.')

if os.path.exists('assets/STDEV_per_family.tsv'):
    cursor = db.cursor()
    sql = "INSERT INTO family_std_feature(Family_ID,tinyAA,smallAA,aliphaticAA,aromaticAA,nonpolarAA,polarAA,chargedAA,basicAA,acidicAA,charge,pI,aindex,instaindex,boman,hydrophobicity,hmoment,SA_Group1_residue0,SA_Group2_residue0,SA_Group3_residue0,HB_Group1_residue0,HB_Group2_residue0,HB_Group3_residue0,AGG,AMYLO,TURN,HELIX,HELAGG,BETA) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s) ON DUPLICATE KEY UPDATE Family_ID=values(Family_ID),tinyAA=values(tinyAA),smallAA=values(smallAA),aliphaticAA=values(aliphaticAA),aromaticAA=values(aromaticAA),nonpolarAA=values(nonpolarAA),polarAA=values(polarAA),chargedAA=values(chargedAA),basicAA=values(basicAA),acidicAA=values(acidicAA),charge=values(charge),pI=values(pI),aindex=values(aindex),instaindex=values(instaindex),boman=values(boman),hydrophobicity=values(hydrophobicity),hmoment=values(hmoment),SA_Group1_residue0=values(SA_Group1_residue0),SA_Group2_residue0=values(SA_Group2_residue0),SA_Group3_residue0=values(SA_Group3_residue0),HB_Group1_residue0=values(HB_Group1_residue0),HB_Group2_residue0=values(HB_Group2_residue0),HB_Group3_residue0=values(HB_Group3_residue0),AGG=values(AGG),AMYLO=values(AMYLO),TURN=values(TURN),HELIX=values(HELIX),HELAGG=values(HELAGG),BETA=values(BETA);"
    data = pd.read_csv('assets/STDEV_per_family.tsv',
                       sep='\t', index_col=False)
    data = data.values.tolist()

    try:
        cursor.executemany(sql, data)
        db.commit()
        print('Done! Import STDEV_per_family.tsv to the gas database.')
    except:
        db.rollback()
        print('Error! Import STDEV_per_family.tsv to the gas database.')

db.close()
