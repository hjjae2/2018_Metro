import numpy as np
from keras.models import Sequential
from keras.layers import Dense, Flatten,Conv2D, MaxPooling2D, Dropout
from keras.layers.normalization import BatchNormalization
from keras.preprocessing.image import ImageDataGenerator
from keras.callbacks import EarlyStopping
import os
from tensorflow.python.keras.callbacks import ModelCheckpoint

np.random.seed(777)

# 0. 모델 체크포인트 설정하기
MODEL_SAVE_FOLDER_PATH ='./keras_model/'
if not os.path.exists(MODEL_SAVE_FOLDER_PATH):
    os.mkdir(MODEL_SAVE_FOLDER_PATH)
model_path = MODEL_SAVE_FOLDER_PATH+'metroAlexnetModel#'+'{epoch:02d}-{val_loss:.4f}.h5'
checkpoint = ModelCheckpoint(filepath=model_path, monitor='val_loss',verbose=1, save_best_only=True)

# 1.데이터셋 생성하기
train_datagen = ImageDataGenerator(rescale=1./255)
train_generator = train_datagen.flow_from_directory(
    'metroImageDataSet/training',
    target_size=(224,224),
    batch_size=30,
    class_mode = 'categorical'
)
val_datagen = ImageDataGenerator(rescale=1./255)
val_generator = val_datagen.flow_from_directory(
    'metroImageDataSet/validation',
    target_size=(224,224),
    batch_size=15,
    class_mode = 'categorical'
)

# 2.모델 구성 (layer 등)
model = Sequential()

# 1st Convolutional Layer
model.add(Conv2D(96,input_shape=(224,224,3), kernel_size=(11,11), strides=(4,4), padding="valid", activation="relu"))
model.add(MaxPooling2D(pool_size=(2,2), strides=(2,2), padding="valid"))
model.add(BatchNormalization())

# 2nd Convolutional Layer
model.add(Conv2D(filters=256, kernel_size=(11,11),strides=(1,1),padding="valid", activation="relu"))
model.add(MaxPooling2D(pool_size=(2,2), strides=(2,2),padding="valid"))
model.add(BatchNormalization())

# 3rd Convolutional Layer
model.add(Conv2D(filters=384, kernel_size=(3,3), strides=(1,1), padding="valid", activation="relu"))
model.add(BatchNormalization())

# 4th Convolutional Layer
model.add(Conv2D(filters=384, kernel_size=(3,3), strides=(1,1), padding="valid", activation="relu"))
model.add(BatchNormalization())

# 5th Convolutional Layer
model.add(Conv2D(filters=256, kernel_size=(3,3), strides=(1,1), padding="valid", activation="relu"))
model.add(MaxPooling2D(pool_size=(2,2), strides=(2,2), padding="valid"))
model.add(BatchNormalization())

# Dense Layer
model.add(Flatten())

# 1st Dense Layer
model.add(Dense(4096, activation="relu"))
model.add(Dropout(0.4))
model.add(BatchNormalization())
# 2nd Dense Layer
model.add(Dense(1000, activation="relu"))
model.add(Dropout(0.4))
model.add(BatchNormalization())
# 3rd Dense Layer
model.add(Dense(3, activation="softmax"))


# 3.모델 학습과정 설정 (compile: loss, optimizer 등)
model.compile(
    loss='categorical_crossentropy',
    optimizer='adam',
    metrics=['accuracy']
)

# EarlyStopping
early_stopping = EarlyStopping(monitor='val_loss',patience=5)


# 4.모델 학습 (fit())
history_ = model.fit_generator(
    train_generator,
    steps_per_epoch=20, # total_training_data:600 / batch_size:30 = 20
    epochs=30,
    validation_data=val_generator,
    validation_steps=13, # total_validation_data:195 / batch_size:15 = 13
    shuffle=True,
    callbacks=[early_stopping,checkpoint]
)

# 5.학습과정 살펴보기
# 6.모델 평가(evaluate())
print("-- Evaluate --")
scores = model.evaluate_generator(val_generator, steps=5)
print("%s: %.2f%%"%(model.metrics_names[1],scores[1]*100))

# 7.모델 사용
print("-- Predict --")
output = model.predict_generator(val_generator, steps=5)
np.set_printoptions(formatter={'float':lambda x: "{0:0.3f}".format(x)})
print(val_generator.class_indices)
print(output)

# model.save("keras_model/metro_alexnet_model1.h5")

# (+) 그래프 
import matplotlib.pyplot as plt
flg, loss_ax = plt.subplots()
acc_ax = loss_ax.twinx()

loss_ax.plot(history_.history['loss'], 'y', label='train_loss')
loss_ax.plot(history_.history['val_loss'],'r',label='val_loss')
acc_ax.plot(history_.history['acc'],'b',label='train_acc')
acc_ax.plot(history_.history['val_acc'],'g',label='val_acc')

loss_ax.set_xlabel('epoch')
loss_ax.set_ylabel('loss')
acc_ax.set_ylabel('accuracy')

loss_ax.legend(loc='upper left')
acc_ax.legend(loc='lower left')

plt.show()



# EarlyStopping
"""
early_stopping = EarlyStopping(monitor='val_loss')
model.fit(~~ callbacks=[early_stopping])
"""