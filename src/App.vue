<template>
  <div id="app">
    <myheader></myheader>
    <axios></axios>

 

    <b-form-file v-model= "file" v-on:change = "onFile"></b-form-file>

    <p>{{ counter2 }} {{ count }}</p>
    <p  v-for="(value, key, index) in tdsData" v-bind:key="index">{{ key }} : {{ value | valueFilter }}</p>
   


    <tab-menu></tab-menu>
    <!-- <router-view/> -->
  </div>
</template>

<script>
import myheader from "./components/Myheader";
import axios from "./components/Axios";
import TabMenu from "@/components/TabMenu";
// import output from '@/components/Output'
// import HelloWorld from '@/components/HelloWorld'

export default {
  name: "App",
  components: {
    TabMenu,
    myheader,
    // HelloWorld,
    axios
    // output,
  },
  data() {
    return {
      // txt: [],
      count: 0,
      file : null,
      tdsData:{
        "Check_AC"  : null,
        "Check_DEF_CE"   : null,
        "Check_SHUNT_SB"  : null,          
        "Combo_DEF_TDB"  : null,
        "Edit_BattName"  : null,
        "Edit_DEF_CDCC"  : null,
        "Edit_DEF_CET"  : null,
        "Edit_DEF_CET2"  : null,
        "Edit_DEF_TDFDDPE"  : null,
        "Edit_DEF_TDFLPE"  : null,
        "Edit_QDB_NDB"  : null,
        "Edit_QDB_NDC"  : null,
        "Edit_SHUNT_CN"  : null,
        "Edit_SHUNT_SB"  : null,
        "Frame_DEF"  : null,
        "Frame_QDB"  : null,
        "Label_DEF_TDFDDTOT2"  : null,
        "Label_DEF_TDFLPETOT2"  : null,
        "Label_QDB_EG_MAX"  : null,
        "Label_QDB_MAX"  : null,
        "Option_1_elemt"  : null,
        "Option_2_elemt"  : null,
        "Option_3_elemt"  : null,
        "Option_6_elemt"  : null,
        "Check_RCDF"  : null,
        "Combo_RCDF_REL"  : null,
        "Edit_DEF_CDCDF"  : null,
        "Edit_DEF_TDCDF"  : null,
        "Edit_DEF_TDFOPE" : null,
        "Frame_RCDF"  : null,
        "Label_DEF_TDFOTOT2"  : null,
        "Check_DEF_CM"  : null,
        "Check_DEF_TARPE"  : null,
        "Check_DEF_TLCPE"  : null,
        "Combo_DEF_CP"  : null,
        "Combo_RCE_REL"  : null,
        "Edit_DEF_battFanDelay"  : null,
        "Edit_DEF_TARPE"  : null,
        "Edit_DEF_TDREE"  : null,
        "Edit_DEF_TEPE"  : null,
        "Edit_DEF_TLCPE"  : null,
        "Frame_AUTO_CHARGE"  : null,
        "Frame_DEF_EG"  : null,
        "Frame_RCE"  : null,
        "Label_DEF_TDEPETOT2"  : null,
        "Option_DEF_DIRECT"  : null,
        "Option_DEF_POST"  : null,
        "Check_TB"  : null,
        "Combo_TB_TP"  : null,
        "Edit_DEF_CB"  : null,
        "Edit_TB_NTA"  : null,
        "Edit_TB_PDD"  : null,
        "Edit_TB_TMT"  : null,
        "Frame_TB"  : null,
        
        "Check_AC_REL"  : null,
        "Combo_BAUDRATE"  : null,
        "Edit_NUM_ESCLAVE"  : null,
        "Frame_COMMUNCATION"  : null,
        "Check_AR_DRED"  : null,
        "Check_AR_DRES"  : null,
        "Check_AR_TMDC"  : null,
        "Frame_AR"  : null,
        "Edit_DC_CURA"  : null,
        "Edit_DC_CURP"  : null,
        "Edit_DC_DDLPDC"  : null,
        "Edit_DC_PDC"  : null,
        "Edit_DC_VMAXDLT"  : null,
        "Edit_DC_VMINDLT"  : null,
        "Frame_DC"  : null,
        "Edit_ENV_ALT"  : null,
        "Edit_ENV_TA"  : null,
        "Frame_ENV"  : null,
        "Label_Derating_ALT"  : null,
        "Label_Derating_temp"  : null,
        "Edit_CBH_NH"  : null,
        "Edit_CBH_TEMPS"  : null,
        "Check_CBH"  : null,
        "Check_CBH_AFF"  : null,
        "Check_CBH_REL"  : null,
        "Combo_CBH_REL"  : null,
        "Frame_CBH"  : null,
        "Check_TEOTDFL"  : null,
        "Check_TEOTDFL_AFF"  : null,
        "Check_TEOTDFL_REL"  : null,
        "Combo_TEOTDFL_REL"  : null,
        "Edit_TEOTDFL_EG"  : null,
        "Edit_TEOTDFL_FL"  : null,
        "Edit_TEOTDFL_TEMPS"  : null,
        "Frame_TEOTDFL"  : null,
        "Check_TUH"  : null,
        "Check_TUH_AFF"  : null,
        "Check_TUH_REL"  : null,
        "Combo_TUH_REL"  : null,
        "Edit_TUH_NH"  : null,
        "Edit_TUH_TEMPS"  : null,
        "Frame_TUH"  : null,
        "Check_CRH"  : null,
        "Check_CRH_AFF"  : null,
        "Check_CRH_REL"  : null,
        "Combo_CRH_REL"  : null,
        "Edit_CRH_NH"  : null,
        "Edit_CRH_TEMPS"  : null,
        "Frame_CRH"  : null,
        "Check_TH"  : null,
        "Check_TH_AFF"  : null,
        "Check_TH_REL"  : null,
        "Combo_TH_REL"  : null,
        "Edit_TH_TEMPS"  : null,
        "Frame_TH"  : null,
        "Combo_LANGUE"  : null,
        "Frame_LANGUE"  : null,
        "Check_TFB"  : null,
        "Check_TFB_AFF"  : null,
        "Check_TFB_REL"  : null,
        "Combo_TFB_REL"  : null,
        "Edit_TFB_NB"  : null,
        "Edit_TFB_TEMPS"  : null,
        "Frame_TFB"  : null,
        "Check_TUB"  : null,
        "Check_TUB_AFF"  : null,
        "Check_TUB_REL"  : null,
        "Combo_TUB_REL"  : null,
        "Edit_TUB_NB"  : null,
        "Edit_TUB_TEMPS"  : null,
        "Frame_TUB"  : null,
        "Check_TRTHOTB"  : null,
        "Check_TRTHOTB_AFF"  : null,
        "Check_TRTHOTB_REL"  : null,
        "Combo_TRTHOTB_REL"  : null,
        "Edit_TRTHOTB_TEMP"  : null,
        "Edit_TRTHOTB_TMAX"  : null,
        "Edit_TRTHOTB_TMIN"  : null,
        "Frame_TRTHOTB"  : null,
        "Check_ADJ_MCV"  : null,
        "Check_ADJ_MTV"  : null,
        "Edit_ADJ_UMAX"  : null,
        "Edit_ADJ_UMIN"  : null,
        "Frame_ADJ"  : null,
        "Check_SDM_AH"  : null,
        "Check_SDM_TR"  : null,
        "Check_SDM_TU"  : null,
        "Frame_SDM"  : null,
        "Check_DTM"  : null,
        "Check_DTM_AFF"  : null, 
        "Check_DTM_REL"  : null,
        "Combo_DTM_REL"  : null,
        "Edit_DTM_TEMPS"  : null,
        "Frame_DTM"  : null,
        "Combo_RN_FREQ"  : null,
        "Combo_RN_IDC"  : null,
        "Combo_RN_NDP"  : null,
        "Combo_RN_UAC"  : null,
        "Combo_RN_UDC"  : null,
        "Edit_RN_CN"  : null,
        "Frame_RN"  : null,
        "Label_CCU_Jumper"  : null,
        "Check_DTP"  : null,
        "Check_DTP_AFF"  : null,
        "Check_DTP_REL"  : null,
        "Combo_DTP_REL"  : null,
        "Edit_DTP_TEMPS"  : null,
        "Frame_DTP"  : null,
        "Check_APP"  : null,
        "Check_MAJ"  : null,
        "Edit_COMMENT"  : null,
        "Edit_CONTROL"  : null,
        "SystemId"  : null,
        "Text_Client"  : null,
        "Text_ClientFinal"  : null,
        "Text_Commande"  : null,
        "Text_Devis"  : null,
        "Text_Nom"  : null,
        "Text_Origine"  : null,
        "Text_Projet"  : null,
        "Edit_SHUNT_SR"  : null,
        "Frame_SHUNT"  : null,
        "Check_DR"  : null,
        "Check_DR_AFF"  : null,
        "Check_DR_REL"  : null,
        "Combo_DR_REL"  : null,
        "Edit_DR_TEMPS"  : null,
        "Frame_DR"  : null,
        "Check_R1"  : null,
        "Check_R1_AFF"  : null,
        "Check_R1_REL"  : null,
        "Combo_R1_REL"  : null,
        "Edit_R1_TDA"  : null,
        "Edit_R1_TEMPS"  : null,
        "Frame_R1"  : null,
        "Check_R2"  : null,
        "Check_R2_AFF"  : null,
        "Check_R2_REL"  : null,
        "Combo_R2_REL"  : null,
        "Edit_R2_TDA"  : null,
        "Edit_R2_TEMPS"  : null,
        "Frame_R2"  : null,
        "Check_R3"  : null,
        "Check_R3_AFF"  : null,
        "Check_R3_REL"  : null,
        "Combo_R3_REL"  : null,
        "Edit_R3_TDA"  : null,
        "Edit_R3_TEMPS"  : null,
        "Frame_R3"  : null,
        "Check_R4"  : null,
        "Check_R4_AFF"  : null,
        "Check_R4_REL"  : null,
        "Combo_R4_REL"  : null,
        "Edit_R4_TDA"  : null,
        "Edit_R4_TEMPS"  : null,
        "Frame_R4"  : null,
        "Edit_OPBVO_CL"  : null,
        "Edit_OPBVO_DELTA"  : null,
        "Edit_OPBVO_TDC"  : null,
        "Edit_OPBVO_TETA"  : null,
        "Frame_OPBV"  : null,

      },
      counter2: "",
      msg: "Hello Vue.js"
    };
  },
  methods: {
    // onFileInput : function(value){
    //   console.log("input", value);
    // },
    onFile: function(e) {
      // eslint-disable-next-line
      // const file = event.name;

      const file = e.target.files[0];
      if (!file || file === null) {
        return ;
      }
      this.count++;
      const n = file.name;
      const s = file.size;
      const t = file.type;
      this.counter2 = `file selected!! [${n} | ${s} | ${t} ]`;

      const reader = new FileReader();
      reader.readAsText(file);
      reader.onload = e => {
        let text = e.target.result;
        var lines = text.toString().split("\n");

        var pattLabel = /<Label>(.*)<\/Label>/i;
        var pattData = /<Donnee>(.*)<\/Donnee>/i;
        let label;
        let data;

        Object.keys(this.tdsData).forEach(key => {
          this.tdsData[key] = null;
        })
       
          lines.forEach(line => {
            var resultLabel = line.match(pattLabel);
            if (resultLabel) {
              label = resultLabel[1];
              // eslint-disable-next-line
              console.log(label);
            }
            var resultData = line.match(pattData);
            if (resultData) {
              data = resultData[1];
              // eslint-disable-next-line
              console.log(data);
              if (label) {
                if (this.tdsData.hasOwnProperty(label)) {            
                this.tdsData[label] = data;             
                } 
                label = undefined;              
              }
            } 
               
              
          });          
          // eslint-disable-next-line
          console.log(this.tdsData);
          this.file = null;
        }
      }                 
    },
    filters: {
      valueFilter : function (v) {    
        if (typeof v === 'string' && v.length === 0){
          // eslint-disable-next-line
          console.log(v.length);
          return '( void )';
        }
        if (v === null){
          return '( null )';
        }
        if (v === undefined){
          return '( undefined )';
        }
        return v;
      }
  }
};
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>